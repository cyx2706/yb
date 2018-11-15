<?php
class ActivityAction extends IndexAction {

    public function index() {

        // 调试
        /*$recordModel = M('ExchangeRecords');
        $status = $recordModel->add(array(
            'yb_userid' => $_SESSION['yb_userid'],
            'exgid'     => 3,
            'num'       => 7,
            'code'      => $_SESSION['yb_userid'],
            'time'      => date('Y-m-d H:i:s'),
        ));


        dump('$status='.$status);

        if (!$status) {
            dump($recordModel->getDbError());
        }

        dump(M('ExchangeGift')->find(3));

        $rollStatus = $recordModel->where(array(
            $recordModel->getPk()   =>  $status
        ))->delete();

        dump('$rollStatus='.$rollStatus);

        dump(M('ExchangeGift')->find(3));*/



        // 数据库id
        $exgid = C('SPCL_GIFT_ID.GIRL_SPORT');

        if ($this->isLogin()) {
            // 表示已经登录
            $this->assign('isLogin',true);

            // 如果url中有传递错误提示,就传递错误提示
            if (isset($_GET['error']) && !empty($_GET['error']) && $_GET['errcode'] == $this->getErrCode($_GET['error'])) {
                $this->assign('err',preg_replace ("/<([^>]*)>/", "", $_GET['error']));
                //$this->assign('isSuccess',false);
            }

            // 无论如何都会显示兑换数量,除非兑换数量为0

            $gift = M('ExchangeGift')->find($exgid);
            $recordModel = M('ExchangeRecords');

            $exNum = $recordModel->where(array(
                'yb_userid' =>  array('eq',$this->getYbUserid()),
                'exgid'     =>  array('eq',$exgid),
            ))->sum('num');

            // 兑换的次数
            $this->assign('exNum',$exNum);
        }
        else {
            // 跳转到推文?
            header('Location:'.U('Index/index'));
        }

        $this->display();
    }


    public function exchange() {

        $exgid = C('SPCL_GIFT_ID.GIRL_SPORT');
        $num = 1;

        // 如果没有兑换过的话, 就进行兑换工作
        $res = $this->payHandle($this->getAssessToken(),$exgid,$num);

        // 兑换成功直接跳转到Index,可以直接判断
        if ($res['status']) {
            header('Location:'.U('index'));
        }
        // 兑换失败的话,传递错误原因
        else {
            // 使用?传参的原因:url采用重写模式,如果不使用?传参,css路径会出错
            header('Location:'.U('index').'?error='.$res['info'].'&errcode='.$this->getErrCode($res['info']));
        }
    }

    /**
     * 早餐券
     */
    public function breakfast() {
        // 早餐券的id
        if ($this->isLogin()) {
            // 表示已经登录
            $this->assign('isLogin',true);

            // 如果url中有传递错误提示,就传递错误提示
            if (isset($_GET['error']) && !empty($_GET['error']) && $_GET['errcode'] == $this->getErrCode($_GET['error'])) {
                $this->assign('err',preg_replace ("/<([^>]*)>/", "", $_GET['error']));
                //$this->assign('isSuccess',false);
            }

            // 无论如何都会显示兑换数量,除非兑换数量为0
            $recordModel = M('ExchangeRecords');
            $recs =
                $recordModel
                    ->alias('REC')
                    ->join('exchange_gift AS GIFT ON GIFT.exgid = REC.exgid')
                    ->where(array(
                        'yb_userid' =>  array('eq',$this->getYbUserid()),
                        'REC.exgid'     =>  array('in',array(C('SPCL_GIFT_ID.BREAKFAST1'),C('SPCL_GIFT_ID.BREAKFAST2'))),
                    ))
                    ->group('REC.exgid')
                    ->field('REC.exgid,name,SUM(REC.num) as total')
                    ->select();
            $exNum1 = 0;
            $exNum2 = 0;
            foreach ($recs as $rec) {
                if ($rec['exgid'] == C('SPCL_GIFT_ID.BREAKFAST1')) {
                    $exNum1 = $rec['total'];
                }
                elseif ($rec['exgid'] == C('SPCL_GIFT_ID.BREAKFAST2')) {
                    $exNum2 = $rec['total'];
                }
            }
            // 兑换的次数
            $this->assign('exNum1',$exNum1);
            $this->assign('exNum2',$exNum2);
        }
        else {
            // 跳转到首页
            header('Location:'.U('Index/index'));
        }
        $this->display();
    }

    public function exchange2() {

        $exgid = (int)$_GET['id'];
        $num = 1;

        // 如果没有兑换过的话, 就进行兑换工作
        $res = $this->payHandle($this->getAssessToken(),$exgid,$num);

        // 兑换成功直接跳转到Index,可以直接判断
        if ($res['status']) {
            header('Location:'.U('breakfast'));
        }
        // 兑换失败的话,传递错误原因
        else {
            // 使用?传参的原因:url采用重写模式,如果不使用?传参,css路径会出错
            header('Location:'.U('breakfast').'?error='.$res['info'].'&errcode='.$this->getErrCode($res['info']));
        }
    }

    private function getErrCode($str) {
        return md5($str.$this->getYbUserid());
    }
}