<?php

/**
 * Class ExTicketAction 兑换奖券的控制器
 * 继承AjaxAction 必须要登录才能兑换
 */
class ExTicketAction extends AjaxAction {

    /**
     * $_POST['code']
     * $_POST['__hash__'] 可能不需要了
     */
    public function index() {
    C('TOKEN_ON',false);
        if ($_POST) {
            sleep(1);
            $this->ajaxReturn($this->handle($_POST));
        }
        $this->ajaxReturn(0,'您没有提交数据',false);
    }

    private function handle($post) {
        $data = null;
        $info = '';
        $status = false;
        $D = D('ExTicket');
        $D->setUid($this->getUid());
        if ($data = $D->create($post)) {
            if ($D->save()) {
                $info = $D->getGiftContent();
                $status = true;
            }
            else {
                $err = $D->getDbError();
                // 如果是自定义的错误
                if (preg_match("/throw_custom_exception_[^ ]*/",$err,$match)
                    // 礼品已经没有了
                    && 'already_none' == str_replace('throw_custom_exception_','',$match[0])) {
                    // 重新再来一次
                    return $this->handle($post);
                }
                // 其他错误
                else {
                    $info = "现在兑换人数较多,系统繁忙,请稍等一下哦~";
                }
            }
        }
        else {
            $info = $D->getError();
        }
        return array('data'=>$data,'info'=>$info,'status'=>$status);
    }
}