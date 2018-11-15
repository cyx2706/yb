<?php
class ExTicketModel extends MyModel {
    protected $_validate = array(
        array('virtual', 'exPermission', '您已经兑换过了,不能再兑换了!', Model::MUST_VALIDATE, 'callback', Model:: MODEL_BOTH),

        array('virtual', 'checkErrNum', '您的兑换错误次数已将超过30次! 您的账户将不能再兑换,如有问题请联系广药易班人员', Model::MUST_VALIDATE, 'callback', Model:: MODEL_BOTH),

        // 考虑到并发性的问题,这个验证应该放在数据库的触发器里面
        // array('code', 'checkCode', '该兑换码已经兑换过了', Model::MUST_VALIDATE, 'callback', Model:: MODEL_BOTH),

        array('code', 'require', '您没有输入兑换码哦~', Model::MUST_VALIDATE, 'regex', Model:: MODEL_BOTH),

        array('code', 'codeIsExist', '您输入的兑换码有误,请认真检查:(', Model::MUST_VALIDATE, 'callback', Model:: MODEL_BOTH),
    );


    public function exPermission() {
        return ! ($this->where(array(
                    'uid' => array('eq',$this->getUid()),
                ))->count());
    }

    /**
     * 检查输入错误的次数,如果次数较多则有暴力破解嫌疑,30次以内允许错误
     * @return bool
     */
    public function checkErrNum() {
        $num = M('ExError')->where(array(
                                    'uid' => array('eq',$this->getUid()),
                                ))->count();
        return $num < 30;
    }


    /*public function checkCode($code) {
        return ! $this->whwere(array(
            'code'  => array('eq',$code),
            'uid'   => array('eq',0)
        ))->count();
    }*/


    protected $ticket;

    /**
     * 检查
     * @param $code
     * @return bool
     */
    public function codeIsExist($code) {
        $this->ticket = $this->find($code);

        if (!$this->ticket) {
            M('ExError')->add(array(
                'code'  => array('eq',$code),
                'uid'   => array('eq',$this->getUid()),
            ));
        }

        return $this->ticket;
    }

    protected $_auto = array(
        array('uid','getUid',Model:: MODEL_BOTH,'callback'),
        array('exgid','getGift',Model:: MODEL_BOTH,'callback'),
        array('extime','getTime',Model:: MODEL_BOTH,'callback'),
    );

    protected $gift;

    public function getGift() {
        $gifts = M('ExGift')->select();
        $rand = rand(1,$this->count());
        $exgid = 0;

        for ($i=0; $i<count($gifts); $i++) {
            if ($i) {
                $gifts[$i]['minDomain'] = $gifts[$i-1]['maxDomain']+1;
            }
            else {
                $gifts[$i]['minDomain'] = 0;
            }
            $gifts[$i]['maxDomain'] = $gifts[$i]['minDomain'] + $gifts[$i]['num'];


            if ($rand<=$gifts[$i]['maxDomain']
                && $rand >= $gifts[$i]['minDomain']) {

                // 记录获得的礼物
                $this->gift = $gifts[$i]['content'];

                // 返回id
                $exgid = $gifts[$i]['exgid'];

                 break;
            }
        }

        return $exgid;
    }

    public function getGiftContent() {
        return $this->gift;
    }


}
?>