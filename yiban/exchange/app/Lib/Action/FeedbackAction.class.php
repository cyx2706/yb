<?php

class FeedbackAction extends Action {

    /**
     * 收集评论
     */
    public function gather() {
        if ($_SESSION['yb_userid']) {
            $list = M('ExchangeFeedback')->where(array('yb_userid'=>array('eq',$_SESSION['yb_userid'])))->order('time desc')->select();
            $this->assign('list',$list);
            $this->display();
        }
        else {
            header('Location:'.U('Index/index'));
        }

    }

    /**
     * 添加反馈
     * $_POST['question']
     */
    public function add() {

        if (!$_SESSION['yb_userid']) {
            $this->ajaxReturn(0,'您还没有登录',false);
        }

        // 消除session 防止暴力破解
        $verify = $_SESSION['verify'];
        unset($_SESSION['verify']);

        if ($verify != md5($_POST['verify'])) {
            $this->ajaxReturn(0,'验证码错误',false);
        }

        if (strlen($_POST['question']) == 0) {
            $this->ajaxReturn(0,'反馈内容不能为空',false);
        }

        $status = M('ExchangeFeedback')->add(array(
            'yb_userid' =>  $_SESSION['yb_userid'],
            'question'  =>  htmlspecialchars($_POST['question'])
        ));

        $this->ajaxReturn(0,$status?'反馈发布成功':'反馈发布失败',$status);
    }

    /**
     * 获取验证码
     */
    Public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
}