<?php
class CommentAction extends AjaxAction {

    public function add() {
        // 先检验是否为已认证用户

        $data = null;
        $info = '';
        $status = false;

        $M = D('Comment');

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

                    $info = "亲,您在150秒之内已经发表过一次评论了哦(防止刷屏现象),歇一会再发吧~";
                }
                // 其他错误
                else {
                    $info = "系统繁忙,歇一会再发吧~";
                    // log $err;
                }
            }
        }
        // 客户端输入错误,返回模型中的错误提示
        else {
            $info = $M->getError();
        }

        $this->ajaxReturn($data?$data:array($_POST,$_FILES), $info, $status);
    }

    public function del() {
        $status =
            M('Comment')->where(array(
                'cmid' =>array('eq',(int)$_POST['id']),
                'uid'  =>$this->getUid()
                ))->save(array('status'=>0));
        $this->ajaxReturn(0,$status?'删除成功':'删除失败',$status);
    }

}