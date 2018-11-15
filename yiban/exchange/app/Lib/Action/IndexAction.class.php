<?php
class IndexAction extends Action {
    public function index(){

        if (get_client_ip() != '127.0.0.1') {

            // 如果还没有登录...就要登录
            if ( !($_GET['code']/* || (isset($_SESSION['yb_userid']) && $_SESSION['yb_userid'])*/) ) {
                header('Location:https://openapi.yiban.cn/oauth/authorize?client_id='.C('YB_APP_ID').'&redirect_uri='.C('YB_CB_URL').'&state='.C('YB_LOGIN_STATE'));
                exit;
            }

            // 应用维护中
            if (C('APP_MAINTENANCE')) {
                $this->assign('errMsg','网薪兑换正在维护中...将在10月17日00点前开启,如有不便敬请原谅');
            }

            //加载类库
            import('@.Behavior.https');

            // 从易班服务器获取accessToken
            $getTokenRes = $this->getAccessTokenFromServer($_GET['code']);
            //dump($getTokenRes);

            // 如果获取成功
            if ($getTokenRes['status']) {
                $assessToken = $getTokenRes['assessToken'];
                $assTkExpire = $getTokenRes['expire'];
                $_SESSION['yb_userid'] = $getTokenRes['yb_userid'];

                // 将assess_token 存在cookie里
                $this->setAssessToken($assessToken, $assTkExpire);

                // 获取用户认证信息
                $getUsrHttps = new https('https://openapi.yiban.cn/user/verify_me',array('access_token'=>$assessToken),https::GET);
                $getUsrRes = json_decode($getUsrHttps->getResponseTxt(),true);

                if ($getUsrRes['status'] == 'success') {
                    // 用户信息
                    $usr = $getUsrRes['info'];

                    if ($usr['yb_schoolname'] == '广东药科大学') {

                        if ($_GET['state'] != C('YB_LOGIN_STATE')) {
                            header('Location:'.U($_GET['state']));
                        }


                        $list = M('ExchangeGift')->where(array('status'=>array('gt',0)))->order('special DESC')->select();
                        $this->assign('list',$list);

                        $M = M('ExchangeRecords');
                        $this->assign('records',
                            $M->
                            join('exchange_gift AS exg ON exg.exgid = exchange_records.exgid')->
//                        where(array('yb_userid'=>array('eq',$_SESSION['yb_userid'])))->
                            where('yb_userid=\''.$_SESSION['yb_userid'].'\' OR yb_userid=\''.$assTkExpire.'\'')->
                            order('time DESC')->
                            field('exrid,exchange_records.exgid,exchange_records.num,name,exchange_records.status,img,time,code,finish')->
                            select());
                        //dump($M->getDbError());
                    }
                    else {
                        $this->assign('errMsg','本轻应用暂时只对广东药科大学学生开放,若您还没有完成实名认证,请先完成实名认证');
                    }
                }
                else {
                    $errMsg = $getUsrRes['info'];
                    $this->assign('errMsg',"OOOOOH! 发生错误了..."."(".$errMsg['msgCN'].")");
                }
            }
            //如果获取失败
            else {
                //提示错误 错误码:001
                switch ($getTokenRes['code']) {
                    case 'e005':
                        header('Location:https://openapi.yiban.cn/oauth/authorize?client_id='.C('YB_APP_ID').'&redirect_uri='.C('YB_CB_URL').'&state='.C('YB_LOGIN_STATE'));
                        $this->assign('errMsg',"访问超时,请检查网络状态 或 重新打开此轻应用");
                        break;
                    default :
                        // 其他错误
                        $this->assign('errMsg',$getTokenRes['info']);
                        break;
                }
            }
        }

        // 测试数据
        else {

            $assTkExpire = '15005021181';
            $_SESSION['yb_userid'] = '1500502118';
            $list = M('ExchangeGift')->where(array('status'=>array('gt',0)))->order('special DESC')->select();
            $this->assign('list',$list);

            // 用户id可以是expires
            $M = M('ExchangeRecords');
            $this->assign('records',
                $M->
                join('exchange_gift AS exg ON exg.exgid = exchange_records.exgid')->
                where('yb_userid=\''.$_SESSION['yb_userid'].'\' OR yb_userid=\''.$assTkExpire.'\'')->
                order('time DESC')->
                field('exrid,exchange_records.exgid,exchange_records.num,name,exchange_records.status,img,time,code,finish')->
                select());
        }


        $this->display();

    }

    /**
     * $_GET id
     * $_GET num
     */
    public function pay() {
        $exgid  = (int)$_GET['id'];
        $num    = (int)$_GET['num'];

        /*$this->ajaxReturn($this->payHandle(
            $this->getAssessToken(),
            $exgid,
            $num
        ));
        return;*/

        if (!$_SESSION['yb_userid']) {
            $this->ajaxReturn(0,'还没有登录',0);
        }

        if ($num<=0) {
            $this->ajaxReturn(0,'数量必须大于0',0);
        }

        $gift = M('ExchangeGift')->find($exgid);

        // 支付网薪的数量*数字

        $pay = $gift['pay']*$num;
        import('@.Behavior.https');

        $recordModel = M('ExchangeRecords');
        // 添加订单到数据库
        // https请求
        $https = new https(
            'https://openapi.yiban.cn/pay/yb_wx',
            array(
                'access_token'  => $this->getAssessToken(),
                'pay'           => $pay
            ),
            https::GET
        );

        // 支付结果
        $payRes = $https->getResponseJson();
        if ($payRes['status'] == 'success') {
            // 支付成功
            if ($payRes['info']) {
//                    $recordModel->commit();
                $data = array(
                    'yb_userid' => $_SESSION['yb_userid'],
                    'exgid'     => $exgid,
                    'num'       => $num,
                    'code'      => $_SESSION['yb_userid'],
                    'time'      => date('Y-m-d H:i:s'),
                );
                $data[$recordModel->getPk()] = $recordModel->add($data);
                $data['name'] = $gift['name'];
                $data['img'] = $gift['img'];

                $this->ajaxReturn($data,'兑换成功~',true);
            }
            // 支付失败
            else {
                $this->ajaxReturn(0,'发生未知错误,请重新尝试',true);
            }
        }
        else {
            $info = $payRes['info'];
            switch ($info['code']) {
                case 'e015':
                    $this->ajaxReturn(0,'您的网薪不足,无法进行兑换',false);
                    break;
                default:
                    $this->ajaxReturn(0,'OOOOH...出错了('.$info['msgCN'].')',false);
                    break;
            }
        }
    }

    /**
     * 将at存在cookie中
     * @param $token
     * @param $expire
     */
    protected function setAssessToken($token,$expire) {
        setcookie('at',$token,$expire);
    }

    /**
     * 从cookie中获取at
     * @return mixed
     */
    protected function getAssessToken() {
        return $_COOKIE['at'];
    }


    /**
     * @param $code string 从易班api内获取的code
     * @return array array('status'=>bool   [,'assessToken'=>string]    [,'info'=>string])
     */
    private function getAccessTokenFromServer($code) {
        //如果能够从缓存中获取
        //暂时不做处理

        //如果没办法从缓存中提取,就用curl
        $args = array(
            'client_id'     =>  C('YB_APP_ID'),     //必填	应用appkey
            'client_secret'  =>  C('YB_APP_SEC'),	//必填	应用appsecret
            'code'          =>  $code,	        //必填	已授权的令牌
            'redirect_uri'  =>  C('YB_CB_URL'),	//必填	应用回调地址
        );
        $https = new https('https://openapi.yiban.cn/oauth/access_token',$args,https::POST);

        $res = null;
        try {
            $res = json_decode($https->getResponseTxt(),true);
        }
        catch (Exception $e) {
            return array('status'=>false,'info'=>$e->getMessage());
        }
        if ($res['access_token']) {
            //dump($res);//e4426222cabb32e29cefe350e9c95faf40c2250c
            //dump(date('Y-m-d H:i:s',$res['expires']));
            //进行缓存操作
            //返回数据
            // yb_userid
            return array(
                'status'=>true,
                'assessToken'=>$res['access_token'],
                'expire'=>$res['expires'],
                'yb_userid'=>$res['userid']);//yb_userid
        }
        else {
            //code 错误号码
            //msgCN 中文提示
            //msgEN 英文提示
            //dump($res);//e4426222cabb32e29cefe350e9c95faf40c2250c
            return array('status'=>false,'info'=>$res['msgCN'],'code'=>$res['code']);
        }
    }

    /**
     * 设置易班用户id
     * @param $userid
     */
    protected function setYbUserid($userid) {
        $_SESSION['yb_userid'] = $userid;
    }

    /**
     * 获取易班用户id
     * @return mixed
     */
    protected function getYbUserid() {
        return $_SESSION['yb_userid'];
    }

    /**
     * 是否登录
     * @return bool
     */
    protected function isLogin() {
        return isset($_SESSION['yb_userid']) && $_SESSION['yb_userid'];
    }

    /**
     * 支付处理
     * @param $access_token
     * @param $exgid
     * @param $num
     * @return array
     */
    protected function payHandle($access_token,$exgid,$num) {
        // 必须登录
        if (!$this->isLogin()) {
            return array('info'=>'还没有登录','status'=>0);
        }

        // 数量不能小于0
        if ($num<=0) {
            return array('info'=>'数量必须大于0','status'=>0);
        }

        // 礼物id不能小于0
        if ($exgid<=0) {
            return array('info'=>'数据提交错误','status'=>0);
        }

        // 寻找礼物
        $gift = M('ExchangeGift')->find($exgid);

        // 兑换物品是否已经下架
        if ($gift['status'] == 0) {
            return array('info'=>'您兑换的物品已下架','status'=>0);
        }

        // 兑换的礼物是否开始兑换
        if (time() < strtotime($gift['start'])) {
            return array('info'=>'还没开始进行兑换,开始时间是'.date('m月d日 H:i:s',strtotime($gift['start'])),'status'=>0);
        }

        $recordModel = M('ExchangeRecords');

        // 检验在兑换周期内是否超过限定数量
        if ($gift['cycle']>0 && $gift['limited_in_cycle']>0) {
            $cycle = $gift['cycle']*24*60*60;
            $startCalcTime = time() - $cycle;
            $cycleSum = $recordModel->where(array(
                'yb_userid' =>  array('eq',$this->getYbUserid()),
                'exgid'     =>  array('eq',$exgid),
                'time'      =>  array('egt',date('Y-m-d H:i:s',$startCalcTime)),// 从周期开始日开始计算 所以是 大于等于开始日
            ))->sum('num');

            // 如果过去兑换的数量+现在兑换的数量 > 周期内限制的兑换数量
            if ($cycleSum+$num > $gift['limited_in_cycle']) {
                return array('info'=>$gift['cycle'].'天之内兑换的数量不能超过'.$gift['limited_in_cycle'].'份,您之前已经兑换了'.$cycleSum.'份','status'=>0);
            }
        }

        // 检验当前兑换的数量是否超过限定数量,还要检验兑换的物品是否有数量限制
        if ($gift['limited']>0){
            $exgCnt =
                $recordModel->
                where(array(
                    'yb_userid'=>array('eq',$this->getYbUserid()),
                    'exgid'=>array('eq',$exgid)))->
                sum('num');

            /*dump($this->getYbUserid());

            dump($recordModel->
            where(array('yb_userid'=>array('eq',$this->getYbUserid()),'exgid'=>array('eq',$exgid)))->
            sum('num'));

            dump($exgCnt);*/

            if ($exgCnt+$num > $gift['limited'] ) {
                return array('info' => $gift['name'].'兑换数量不能超过'.$gift['limited'].'份','status' => 0);
            }
        }

        // 礼物剩余问题需要放在数据库触发器中


        // 支付网薪的总价 = 单价*数量
        $pay = $gift['pay']*$num;

        // 先加入数据库,因为数据库中的触发器需要检验数量,如果兑换请求发生错误可以根据id删除掉
        // 就是为了防止网薪支付成功却礼物数量不足的问题
        $data = array(
            'yb_userid' => $_SESSION['yb_userid'],
            'exgid'     => $exgid,
            'num'       => $num,
            'code'      => $_SESSION['yb_userid'].rand(0,9),
            'time'      => date('Y-m-d H:i:s'),
        );
        $addStatus    = $recordModel->add($data);

        // 添加到数据库失败
        if ($addStatus == false) {
            return array('info'=>'OOOOH...出错了(数据写入错误)'.$recordModel->getDbError(),'status'=>false);
        }

        // 由于前端需要获得数,补充数据
        $data[$recordModel->getPk()] = $addStatus;  // 记录返回的id
        $data['name'] = $gift['name'];              // 记录返回的物品名称
        $data['img'] = $gift['img'];                // 记录返回的物品图片

        // 前端返回的提示
        $info = '兑换成功~';
        // 前端返回的表示状态
        $status = true;

        // 获取支付结果
        $payRes = $this->payHttps($access_token,$pay);



        // 发送请求发生错误
        if ($payRes['status'] != 'success') {
            $status = false;
            switch ($payRes['info']['code']) {
                case 'e015':
                    $info = '您的网薪不足,无法进行兑换';
                    break;
                default:
                    $info = 'OOOOH...出错了('.$payRes['info']['msgCN'].')';
                    break;
            }
        }


        // $payRes['info'] bool 类型
        // 支付失败 $payRes['status'] = success, 但info = false
        if (!$payRes['info']) {
            // 提示支付失败 未知错误
            $status = false;
            $info = '发生未知错误,请重新尝试!';
        }

        // 网薪支付出现任何错误情况的话,把原本插入的数据删除掉
        if (!$status) {
            $recordModel->where(array(
                $recordModel->getPk()   =>  $data[$recordModel->getPk()]
            ))->delete();
        }

        // 返回数据
        return array(
            'data'=>$status ? $data : 0,
            'info'=>$info,
            'status'=>$status);

    }

    /**
     * @param $access_token
     * @param $pay
     * @return array
     */
    protected function payHttps($access_token,$pay) {
        // 本地调试默认为成功
        if (get_client_ip() == '127.0.0.1') {
            return array('status'=>'success','info' => true);
        }

        import('@.Behavior.https');

        // https请求
        $https = new https(
            'https://openapi.yiban.cn/pay/yb_wx',
            array(
                'access_token'  => $access_token,
                'pay'           => $pay
            ),
            https::GET
        );

        // 支付结果
        $payRes = $https->getResponseJson();


        return $payRes;
    }
}