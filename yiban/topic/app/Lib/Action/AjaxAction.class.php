<?php
/**
 * Class AjaxAction
 * 所有通过ajax进行curd操作的控制器都必须继承这个类
 */
class AjaxAction extends CommonAction {

    protected function throwUnlogErr() {
        $this->ajaxReturn(null,'您还没有登录,请先登录',false);
    }

}
?>