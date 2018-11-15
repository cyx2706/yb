<?php

class Adm1nAction extends AdmAction {

    /**
     * 没有登录就跳转到登录
     */
    protected function throwUnlogErr() {
        if (!$this->isLog()) {
            header('Location:https://openapi.yiban.cn/oauth/authorize?'.
                'client_id='.C('YB_APP_ID').
                '&redirect_uri='.C('YB_CB_URL').
                '&state='.'Adm1n/log');
        }
        else {
            throw new Exception('您不是管理员!');
        }
    }

    /**
     * 管理员的session与实际中的用户id并不一样
     */
    public function log() {
        // 原本的uid转移到real中
        $this->setRealId($this->getUid());
        // 将uid设置为公众号的uid
        $vuser = M('VirtualUser')->where(array(
            'real_uid'  =>  array('eq',$this->getRealId())
        ))->find();

        if ($vuser && is_array($vuser)) {
            $this->setUid($vuser['uid']);
        }
        // 如果找不到就代表不存在这个管理员账号
        else {
            throw new Exception('您不是管理员,无法登录到后台');
        }

        // 更新登录的ip的时间 和 最后登录时间
        M('VirtualUser')->
        where(array(
            'real_uid'  =>  array('eq',$this->getRealId()),
            'uid'       =>  array('eq',$this->getUid())
        ))->
        save(array(
            'lastip'        =>  get_client_ip(),
            'lastlog'       =>  date('Y-m-d H:i:s')
        ));

        // 跳转
        header('Location:'.U('manage'));
    }


    /**
     * 管理页面,后台控制器adm会判断是否管理员,不需要在这里验证
     */
    public function manage() {
        $this->assign('list',M('Topic')->order('updtime desc')->select());
        $this->display();
    }

}