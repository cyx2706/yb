<?php
class Adm1nAction extends Action {

    /*public function demo() {
        $admList = M('ExchangeAdmin1')->select();

        foreach ($admList as &$adm) {
            $adm['password'] = $this->encrypt($adm['password']);
        }
        M('ExchangeAdmin')->addAll($admList);
    }*/

    private function encrypt($pass) {
        return md5("wangxinDui换".$pass."鼓腹含和剧哦");
    }

    /**
     * 登录页面
     */
    public function l0g1nbyy1ban() {
        C('TOKEN_ON',false);
        if ($_POST) {
            if ($_SESSION['verify'] != md5($_POST['verify'])) {
                // 消除session防止暴力破解
                $_SESSION['verify'] = null;
                echo "验证码错误<br>";
            }
            else {
                $adm = M('ExchangeAdmin')->find($_POST['username']);

                if (!$adm
                    || $adm['status'] < 1
                    || $this->encrypt($_POST['password']) != $adm['password']) {

                    echo "账号密码错误<br>";
                }
                else {
                    $_SESSION['adm'] = $adm['username'];
                    header('Location:'.U('statusSett1ng'));
                }
            }
        }
        $this->display();
    }

    /**
     * 获取验证码
     */
    Public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }

    /**
     * 设定页面
     */
    public function statusSett1ng() {
        // 需要登录后操作
        if  (!isset($_SESSION['adm']) || !$_SESSION['adm']) {
            header('Location:'.U('l0g1nbyy1ban'));
        }

        if ($_GET['code']) {
            $M = M('ExchangeRecords');
            $this->assign('list',
                $M->alias('exr')->
                join('LEFT JOIN exchange_gift AS exg ON exr.exgid = exg.exgid')->
                where(array('code'=>array('eq',$_GET['code'])))->
                field('exg.img,exrid,yb_userid,exr.exgid,name,exr.num,exr.status,exr.time,exr.finish,exr.adm,exr.remark')->
                order('exr.status,exr.time desc')->
                select()
            );
            //dump($M->getDbError());
        }
        $this->display();
    }

    /**
     * 设置状态为完成
     * post id
     */
    public function finish() {
        if  (!isset($_SESSION['adm']) || !$_SESSION['adm']) {
            $this->ajaxReturn(0,'请先登录',0);
        }

        $exrid = (int) $_POST['id'];

        $Model = M('ExchangeRecords');
        $status = $Model->
        where(array(
            'exrid'     =>  array('eq',$exrid)
        ))->
        save(array(
            'finish'    =>  date('Y-m-d H:i:s'),
            'adm'       =>  $_SESSION['adm'],
            'remark'    =>  htmlspecialchars($_POST['remark']),
            'status'    =>  1,
        ));

        $this->ajaxReturn(array($_POST,$_SESSION['adm']),$status ? '操作成功' : '操作失败\n错误提示:'.$Model->getDbError(),$status);
    }

    /**
     * 查看结果
     */
    public function show() {
        // 需要登录后操作
        if  (!isset($_SESSION['adm']) || !$_SESSION['adm']) {
            header('Location:'.U('l0g1nbyy1ban'));
        }


        $M = M('ExchangeRecords');
        $res = $M->alias('exr')->
        join('LEFT JOIN exchange_gift AS exg ON exr.exgid = exg.exgid')->
        group('exg.exgid')->
//        where(array('code'=>array('eq',$_GET['code'])))->
        field('exg.name as 名称,SUM(exr.num) as 兑换了')->
//        order('exr.status,exr.time desc')->
        select();
        dump($res);
        dump($M->getDbError());
//        $this->display();
    }


}