<?php

/**
 * Class TopicAction
 * 目前只有管理员才能发布滑滑梯
 */
class TopicAction extends AdmAction {

    /**
     * $_POST 字段
     *
     * typeid 类型
     * title 标题
     * content 内容
     */
    public function add() {

        $data = null;
        $info = '';
        $status = false;

        $M = D('Topic');
        $M->setUid($this->getUid());
        if ($data = $M->create()) {
            if ($M->add()) {
                $info = '发布成功';
                $status = true;

                // 找到刚刚发布的话题的主键ID
                $data['tid'] =
                    $M->where(array(
                        'uid'       => array('eq',$this->getUid(),
                        'addtime'   => array('eq',$data['addtime']))))->
                    order('addtime DESC')->
                    limit('1,1')->
                    getField('tid');
            }
            // 添加到数据库失败
            else {
                // 获取数据库抛出的错误
                $err = $M->getDbError();
                // 如果是自定义的错误
                if (preg_match("/throw_custom_exception_[^ ]*/",$err,$match)
                    // 发布过于频繁
                    && 'too_frequently' == str_replace('throw_custom_exception_','',$match[0])) {

                    if ($this->isAdm()) {
                        $info = "每60秒最多允许发布一条话题";
                    }
                    else {
                        $info = "亲,您在3分钟之内已经发布过一篇了哦(防止刷屏现象),歇一会再发吧~";
                    }
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

        $data = null;
        $info = '';
        $status = false;

        $M = D('Topic');
        $M->setUid($this->getUid());
        if ($data = $M->create()) {
            if ($M->save()) {
                $info = '修改成功';
                $status = true;
            }
            // 添加到数据库失败
            else {
                // 获取数据库抛出的错误
                $info = $M->getDbError();
            }
        }
        // 客户端输入错误,返回模型中的错误提示
        else {
            $info = $M->getError();
        }

        $this->ajaxReturn($data?$data:$_POST, $info, $status);
    }


}