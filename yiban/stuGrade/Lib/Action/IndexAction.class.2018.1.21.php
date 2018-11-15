<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {

    /**
     * 请求页面
     */
    public function index(){

        //如果cookiel里面有学号
        if ($this->isGetFromCookie()) {
            $stu_id = $this->getCookieStuId();
            $this->assignStuGrade($stu_id);
            $this->unsetCookieStuId();
        }
        else {
            //yiban
            //cyx_2017_7_2
            $state = 'CYX';
            if (!($_GET['code'] && $_GET['state'] == $state)) {
                header('Location:https://openapi.yiban.cn/oauth/authorize?client_id='.C('YB_APP_ID').'&redirect_uri='.C('YB_APP_CB_URL').'&state='.$state);
                exit;
            }

            //加载类库
            import('@.Behavior.https');

            //获取accessToken
            $getTokenRes = $this->getAccessToken($_GET['code']);

            //如果获取成功
            //dump($getTokenRes);
            if ($getTokenRes['status']) {
                $assessToken = $getTokenRes['assessToken'];
                $getUsrHttps = new https('https://openapi.yiban.cn/user/verify_me',array('access_token'=>$assessToken),https::GET);
                $getUsrRes = json_decode($getUsrHttps->getResponseTxt(),true);

                if ($getUsrRes['status'] == 'success') {
                    $usr = $getUsrRes['info'];
                    if ($usr['yb_schoolname'] == '广东药科大学') {
                        $stu_id = $usr['yb_studentid'];

                        //如果没有设置cookie那么就设定一个cookie
                        if (!$this->isGetFromCookie()) {
                            $this->setCookieStuId($stu_id);
                        }
                        $this->assignStuGrade($stu_id);
                    }
                    else {
                        $this->assign('errMsg','非本校学生不可查询');
                    }
                }
                else {
                    $errMsg = $getUsrRes['info'];
                    $this->assign('errMsg',"当前访问人数较多,服务器繁忙"."(".$errMsg['msgCN'].")");
                }

                /*if (!$stu_id)
                    $this->assign('errMsg',"当前访问人数加多,服务器繁忙"."(".$errMsg['msgCN'].")");
                else {
                    $this->assignStuGrade($stu_id);
                }*/
            }
            //如果获取失败
            else {
                //提示错误 错误码:001
                switch ($getTokenRes['code']) {
                    case 'e005':
                        header('Location:https://openapi.yiban.cn/oauth/authorize?client_id='.C('YB_APP_ID').'&redirect_uri='.C('YB_APP_CB_URL').'&state='.$state);
                        $this->assign('errMsg',"访问超时,请检查网络状态 或 重新打开此轻应用");
                        break;
                    default :
                        $this->assign('errMsg',$getTokenRes['info']);
                        break;
                }
            }
        }
        $this->display();
        //exit;
    }

    /**
     * @param $code string 从易班api内获取的code
     * @return array array('status'=>bool   [,'assessToken'=>string]    [,'info'=>string])
     */
    private function getAccessToken($code) {
        //如果能够从缓存中获取
        //暂时不做处理

        //如果没办法从缓存中提取,就用curl
        $args = array(
            'client_id'     =>  C('YB_APP_ID'),     //必填	应用appkey
            'client_secret'  =>  c('YB_APP_SEC'),	//必填	应用appsecret
            'code'          =>  $code,	        //必填	已授权的令牌
            'redirect_uri'  =>  C('YB_APP_CB_URL'),	//必填	应用回调地址
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
            return array('status'=>true,'assessToken'=>$res['access_token']);
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
     * 根据学生的学号直接输出到模板
     * @param $stu_id string 学生的学号
     */
    private function assignStuGrade($stu_id) {
        $list = null;
        $getTimes = 3;
        $getListErrMsg = null;
        for ($i = 0; $i < $getTimes; $i++) {
            try {
                //睡眠1秒
                sleep(1);
                $list = M('grade_'.C('START_YEAR').'_'.C('END_YEAR').'_'.C('TERM'))->where("XH='$stu_id'")->field('KCMC subjectName,QMCJ grade1,ZPCJ1 grade2')->select();
            }catch (Exception $e) {
                $getListErrMsg = $e->getMessage();
            }

            if ($list) {
                $getListErrMsg = null;
                break;
            }
        }
        if (!$list && $getListErrMsg)
            $this->assign('errMsg',"现查询人数过多,系统繁忙,请错开高峰期查询");
        else {
            $this->assign('list',$list);
        }
    }

    /**
     * 获取学号的加密签名,防止某些用户恶意修改cookie中的学号
     * @param $stu_id string 学号
     * @return string 签名字符串
     */
    private function getIdSign($stu_id) {
        return md5("撒大声说是".$stu_id."的话的话分段函数符合度低分大户活篁很多分，；");
    }

    /**
     * @return bool 判断cookie中是否具有学号信息
     */
    private function isGetFromCookie() {
        return isset($_COOKIE['stuid']) && isset($_COOKIE['stuid'])
        && $_COOKIE['stuid_sign'] == $this->getIdSign($_COOKIE['stuid'])
        && ctype_digit($_COOKIE['stuid']);
    }

    /**
     * @return string 返回cookie中的学号
     */
    private function getCookieStuId() {
        return $_COOKIE['stuid'];
    }

    /**
     * @param $stu_id string 把学生的学号缓存在cookie中
     */
    private function setCookieStuId($stu_id) {
        setcookie('stuid',$stu_id,time()+15*60);
        setcookie('stuid_sign',$this->getIdSign($stu_id),time()+15*60);
    }

    /**
     * 删除所有与学号相关的cookie
     */
    private function unsetCookieStuId() {
        //cookie只能用一次
        setcookie('stuid',null,time()-100);
        setcookie('stuid_sign',null,time()-100);
    }
}