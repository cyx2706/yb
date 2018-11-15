<?php
class LoginAction extends CommonAction {

    public function usr() {
        // 如果有登陆数据就处理登录的数据
        // 普通登录检验$_GET['code']
        // 如果错误
            // 返回错误提示
        // 如果成功
            // 检验是否认证用户,如果是就记录认证信息
            // 更新最后一次登录的ip及时间

        // 显示登录结果

        list($state,$hash) = explode('/',$_GET['state'],2);
        // state参数错误,提示错误
        if ($state != C('YB_LOGIN_STATE')) {
            $this->throwErr('OOOOOOOOOOOOOH~,发生错误了(网址错误)');
        }
        // state参数正确
        else {
            // 加载https类
            import('@.Behavior.https');

            // 获取 access_token
            $res = (new https('https://openapi.yiban.cn/oauth/access_token',
                array(
                    'client_id'         =>C('YB_APP_ID'),
                    'client_secret'     =>C('YB_APP_SEC'),
                    'code'              =>$_GET['code'],
                    'redirect_uri'      =>C('YB_CB_URL')
                ),
                https::POST))->getResponseJson();

            // 如果获取 access_token 成功
            if ($res['userid'] && $res['access_token']) {
                // 寻找对应的id的用户
                $userModel = M('User');
                $user = $userModel->where(array('yb_userid'=>array('eq',$res['userid'])))->find();

                // 如果用户不存在数据库就通过易班api获取用户信息
                if (!$user) {
                    // 先验证用户是否已经进行实名认证
                    $isReal = (new https('https://openapi.yiban.cn/user/is_real',
                        array(
                            'access_token'      =>$res['access_token'],
                            'yb_userid'         =>$res['userid'],
                        ),
                        https::GET))->getResponseJson();

                    // 请求出错(验证实名)
                    if (0 && $isReal['status'] != 'success') {
                        $this->throwErr('OOOOOOOOOOOOOH~,发生错误了(验证实名的时候出错了 :'.$isReal['info']['msgCN'].')');
                    }
                    // 请求正常
                    // 没有进行校方(实名)认证
                    elseif (0 && $isReal['info']){
                        $this->throwErr('请先完成校方认证<a href="">戳这里!</a>');
                    }
                    // 已经进行实名认证了,进一步获取用户信息
                    else {
                        $getUserInfo = (new https('https://openapi.yiban.cn/user/me',
                            array(
                                'access_token'      =>$res['access_token'],
                            ),
                            https::GET))->getResponseJson();

                        // 请求获取信息出错
                        if ($getUserInfo['status'] != 'success') {
                            $this->throwErr('OOOOOOOOOOOOOH~,发生错误了(获取您的信息的时候出错了 :'.$getUserInfo['info']['msgCN'].')');
                        }
                        // 如果获取成功,加入数据库
                        else {
                            $user = array_merge($getUserInfo['info'],array('status'=>1,'addtime'=>date('Y-m-d H:i:s')));
                            $user['nick'] = $getUserInfo['info']['yb_usernick'] ? $getUserInfo['info']['yb_usernick'] : '未知用户';
                            $user['uid'] = $userModel->add($user);
                        }
                    }
                }

                // 设置用户session
                if ( $this->setSession($user) ){
                    // 如果没有设置id,必须要先设置id
                    if (!$user['nick']) {
                        $this->throwErr('OOOOOOOOOOOOOH~,请先设置id');
                    }
                    else {
                        // 记录最后登陆时间和ip
                        header('Location:'.C('SERVER_ROOT').'/#'.$hash);
                    }
                }
                // 被封号的用户不允许登录
                else {
                    $this->throwErr('您已被禁止登陆到此轻应用');
                }
            }
            // 获取 access_token 失败
            else {
                $this->throwErr('OOOOOOOOOOOOOH~,发生错误了(获取 access_token 失败 :'.$res['info']['msgCN'].')');
            }
        }
    }

    /**
     * @param string $err
     * @throws Exception $err
     */
    protected function throwErr($err) {
        header('Content-type:text/Html;charset=UTF-8');
        throw new Exception($err);
    }

    /**
     * 管理员登录
     */
    public function adm() {

        if (isset($_POST) && !empty($_POST)) {
            // 管理员登录检验账号密码验证码 virtual_user
            // 如果错误记录错误次数,超过5次冻结ip
            // 如果登录成功
        }
        // 此处需要调用
        else {
            C('TOKEN_ON',true);
            //
        }
    }

}