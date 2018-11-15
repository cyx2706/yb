<?php
class IndexAction extends Action {
    public function index(){
        $this->display();
    }

    public function sub() {
        //header('Content-type:text/Html;charset=UTF-8');
        if ($_POST) {
            $data = null;
            $info = '';
            $status = false;
            $M = D('Recruit');
            /*if($_SESSION['verify'] != md5($_POST['verify'])) {
                $info = '验证码错误！';
            }*/
            if ($data = $M->create()) {
                if ($M->add()) {
                    $info = '非常感谢您对我们的认可,面试要加油哦!';
                    $status = true;
                }
                else {
                    $data = array($_POST,$data);
                    $info = 'OOOOOH! 出错了,9月10到11日到我们一二饭摊位提交纸质版报名表吧...';
                }
            }
            else {
                $info = $M->getError();
            }
            $this->ajaxReturn($data,$info,$status);
        }
        else {
            $this->ajaxReturn(0,'OOOOOH! 发生错误了...',false);
        }
    }

    Public function getVerify(){
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
}