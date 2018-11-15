<?php
class CommonAction extends Action {

    public function __construct() {
        if ($this->isLog()) {
            parent::__construct();
        }
        else {
            $this->throwUnlogErr();
        }
    }

    /**
     * 获取用户uid
     * @return int
     */
    protected function getUid() {
        return (int)$_SESSION['uid'];
    }

    /**
     * @var array 程序中缓存用户信息的变量
     */
    protected $tmp;

    protected function getUser() {
        return isset($this->tmp['user']) ?
            $this->tmp['user'] :
            ($this->tmp['user'] = M('User')->find($this->getUid()));
    }

    /**
     * 获取用户权限表示数字
     * @return int
     */
    protected function getAuthority() {
        return (int)$_SESSION['authority'] ? (int)$_SESSION['authority'] : 1;
    }

    /**
     * @param $user array 用户的数据结构(从数据库中获取)
     * @return bool 代表是否设置成功,如果设置失败那么就代表这个用户已经被屏蔽 不可以再登录
     */
    protected function setSession($user) {

        if ($user['status'] > 0) {
            $_SESSION['uid'] = $user['uid'];

            if ($user['status'] > 1) {
                $_SESSION['authority'] = $user['status'];
            }
            return true;
        }
        return false;
    }


    /**
     * 表示是否已经登录
     * @return bool
     */
    protected function isLog() {
        // 开发期间 无视
        //return true;
        return isset($_SESSION['uid'])
            && $_SESSION['uid'] > 0;
    }

    protected function isAdm() {
        return isset($_SESSION['authority'])
            && $_SESSION['authority'] > 2;
    }

    /**
     * 如果用户没有登录,那就执行以下函数
     */
    protected function throwUnlogErr() {
        // 普通页面打开不需要登录权限,所以实际上不抛出错误
        parent::__construct();
    }

    /**
     * @param $err string 错误信息
     */
    protected function throwErr($err) {
        $this->assign('error',$err);
        $this->display('Error:index');
        exit;
    }
}