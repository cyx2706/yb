<?php
class IndexAction extends CommonAction {

    public function index(){

        $this->assign('uid',$this->getUid());

        $this->assign('user',$this->getUser());

        // 是否已经登录
        $this->assign('isLogin',$this->isLog() ? 1 : 0);

        // 是否为管理员
//        $this->assign('isAdm',$this->isAdm() ? 1 : 0);
        $this->assign('isAdm',$this->isAdm() ? 1 : 0);

        //显示登录的Url
        $this->assign('logUrl', U('Login/usr'));


        $this->display();
    }

}