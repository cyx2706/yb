<?php
class LoginAction extends CommonAction {

    public function usr() {
        list($state,$hash) = explode('/',$_GET['state'],2);


        // 加载https类
        import('@.Behavior.https');

        // 获取assess_token
        $res = $this->getAssessTk($_GET['code']);

        // 获取 access_token 失败
        if (!($res['userid'] && $res['access_token'])) {
            if ($res['code'] == 'e005') {
                header('Location:https://openapi.yiban.cn/oauth/authorize?'.
                    'client_id='.C('YB_APP_ID').
                    '&redirect_uri='.C('YB_CB_URL').
                    '&state='.$_GET['state']);
                exit;
            }

            $this->throwErr('OOOOOOOOOOOOOH~,发生错误了(获取 access_token 失败 :'.$res['msgCN'].')');
        }
        // 如果获取 access_token 成功
        else {

            // cookie 保存 access_token
            // $this->setAssessToken($res['access_token'],$res['expires']);

            // 获取用户信息
            $user = $this->getUserFromYibanId($res['userid'],$res['access_token'],$res['expires']);

            // 设置用户session
            if ( $this->setSession($user) ){

                if ($state == C('YB_LOGIN_STATE')) {
                    header('Location:'.C('SERVER_ROOT').'/#'.$hash);
                }
                else {
                    header('Location:'.U("$state/$hash"));
                }

            }
            // 被封号的用户不允许登录
            else {
                $this->throwErr('您已被禁止登陆到此轻应用');
            }
        }
    }

    /**
     * @param $err string
     * @param $status int
     * 0代表意外错误提示刷新页面
     * 1表示没有进行校方认证
     * 2表示用户没有id需要设置id
     */
    protected function throwErr($err,$status = 0) {
        header('Content-type:text/Html;chaset=UTF-8');
        throw new Exception($err);


        $this->assign('err',$err);
        $this->display('Login:Error');
        exit;
    }

    /**
     * 获取登录的assess_token
     * @param $code string code参数
     * @return mixed
     */
    private function getAssessTk($code) {
        // 获取 access_token
        $getAssTkn = new https('https://openapi.yiban.cn/oauth/access_token',
            array('client_id'         => C('YB_APP_ID'),
                'client_secret'     => C('YB_APP_SEC'),
                'code'              => $code,
                'redirect_uri'      => C('YB_CB_URL')
            ),https::POST);
        return $getAssTkn->getResponseJson();
    }

    /**
     * @param $user_id string 用户的易班id
     * @param $ass_tk string assess_token
     * @param $expires int 时间戳
     * @return array 返回用户的数据结构
     */
    private function getUserFromYibanId($user_id,$ass_tk,$expires) {
        // 寻找对应的id的用户
        $userModel = M('User');
        $user = $userModel->where(array('yb_userid'=>array('eq',$user_id)))->find();
        $isNewUser = false;

        // 如果用户不存在 需要检验用户是否为实名认证用户
        if (!$user) {
            // 是新用户
            $isNewUser = true;
            $user      = array();

            // 先验证用户是否已经进行实名认证
            $isRealHttps = new https('https://openapi.yiban.cn/user/is_real',
                array('access_token' =>$ass_tk,'yb_userid' =>$user_id),
                https::GET);
            $isReal = $isRealHttps->getResponseJson();

            // 请求出错(验证实名)
            if (C('REAL_NAME_REG') && $isReal['status'] != 'success') {
                $this->throwErr('OOOOOOOOOOOOOH~,发生错误了(验证实名的时候出错了 :'.$isReal['info']['msgCN'].')');
            }
            // 请求正常
            // 没有进行校方(实名)认证
            elseif (C('REAL_NAME_REG') && $isReal['info']){
                $this->throwErr('请先完成校方认证',1);
            }
        }

        // 已经进行实名认证了,进一步获取用户信息
        if (C('REAL_NAME_REG')) {
            $url = 'https://openapi.yiban.cn/user/real_me';
        }
        else {
            $url = 'https://openapi.yiban.cn/user/me';
        }

        $getUserInfoHttps = new https($url,
            array('access_token'      =>$ass_tk,),
            https::GET);

        $getUserInfo = $getUserInfoHttps->getResponseJson();

        // 请求获取信息出错
        if ($getUserInfo['status'] != 'success') {
            $this->throwErr('OOOOOOOOOOOOOH~,发生错误了(获取您的信息的时候出错了 :'.$getUserInfo['info']['msgCN'].')');
        }
        // 如果获取成功,加入数据库
        else {
            $user = array_merge($user,$getUserInfo['info']);

            // 每次登陆都要刷新用户的名称、token、和过期时间
            $flushData = array(
                'lastlog'   =>  date('Y-m-d H:i:s'),
                'lastip'    =>  get_client_ip(),
                'nick'      =>  $user['yb_usernick'],
                'yb_sex'    =>  $user['yb_sex'],
                'token'     =>  $ass_tk,
                'token_expires'=>   $expires
            );

            // 如果是新用户就添加到数据库
            if ($isNewUser) {
                $user = array_merge($user,$flushData);
                $user['status']     = 1;
                $user['uid']        = $userModel->add($user);
                $user['isNew']      = true;

            }
            // 旧用户只需要刷新数据即可
            else {
                $userModel->
                where(array('yb_userid'=>array('eq',$user['yb_userid'])))->
                save($flushData);
            }

            if ($userModel->getDbError()) {
                $this->throwErr('系统错误,请稍后');
            }
            return $user;
        }

    }


//    public function demo() {
//        $v_str = "/-*-*+/*/*䮟䯐嵴汪静会定级赛大师傅黄金时段第三个佛挡杀佛是多少机会是大家活动结束hsdjk;545";
//        $data = array();
//        for ($i=1; $i<=5000; $i++) {
//            $data[] = array(
//                /*'输入以下兑换码,即有机会获取免费电影券及笔记本: '.*/
//                'code' => substr(md5($v_str.$i),0,10),
//            );
//        }
//        M('ExTicket')->addAll($data);
//        return;
//    }
}
?>