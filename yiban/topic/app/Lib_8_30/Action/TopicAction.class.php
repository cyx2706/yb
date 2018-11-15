<?php
class TopicAction extends AjaxAction {

    /**
     * $_POST 字段
     *
     * typeid 类型
     * title 标题
     * content 内容
     */
    public function add() {
        $this->ajaxReturn(0,'暂不开放',false);
        // 先检验是否为已认证用户

        $data = null;
        $info = '';
        $status = false;

        $M = D('Topic');
        $M->setUid($this->getUid());
        if ($data = $M->create()) {
            if ($M->add()) {
                $info = '发布成功';
                $status = true;
            }
            // 添加到数据库失败
            else {
                // 获取数据库抛出的错误
                $err = $M->getDbError();
                // 如果是自定义的错误
                if (preg_match("/throw_custom_exception_[^ ]*/",$err,$match)
                    // 发布过于频繁
                    && 'too_frequently' == str_replace('throw_custom_exception_','',$match[0])) {

                    $info = "亲,您在5分钟之内已经发布过一篇了哦(防止刷屏现象),歇一会再发吧~";
                }
                // 其他错误
                else {
                    $info = "系统繁忙,请稍后再发吧~";
                    // log $err;
                }
            }
        }
        // 客户端输入错误,返回模型中的错误提示
        else {
            $info = $M->getError();
        }

        $this->ajaxReturn($data?$data:$_POST, $info, $status);
    }

    /**
     * $_POST 字段
     *
     * tid 主键
     * typeid 类型
     * title 标题
     * content 内容
     */
    public function upd() {
        $this->ajaxReturn(0,'暂不开放',false);
    }


}