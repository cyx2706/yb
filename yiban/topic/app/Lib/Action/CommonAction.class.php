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
     * @var array 程序中缓存用户信息的变量
     */
    protected $tmp;

    /**
     *
     * @param string $field
     * @return mixed
     */
    protected function getUser($field = '') {
        $user = isset($this->tmp['user']) ?
            $this->tmp['user'] :
            ($this->tmp['user'] = M('User')->find($this->getUid()));

        return strlen($field)>0 ? $user[$field] : $user;
    }

    /**
     * 获取用户uid
     * @return int
     */
    protected function getUid() {
        return (int)$_SESSION['uid'];
    }

    /**
     * 设置用户的id
     * @param $uid
     */
    protected function setUid($uid) {
        $_SESSION['uid'] = $uid;
    }

    /**
     * 获取用户权限表示数字
     * @return int
     */
    protected function getAuthority() {
        return (int)$_SESSION['authority'] ? (int)$_SESSION['authority'] : 1;
    }

    /**
     * 设置用户权限
     * @param $status
     */
    protected function setAuthority($status) {
        $_SESSION['authority'] = $status;
    }

    /**
     * @param $user array 用户的数据结构(从数据库中获取)
     * @return bool 代表是否设置成功,如果设置失败那么就代表这个用户已经被屏蔽 不可以再登录
     */
    protected function setSession($user) {

        if ($user['status'] > 0) {
            $this->setUid($user['uid']);

            if ($user['status'] > 1) {
                $this->setAuthority($user['status']);
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
//        return true;
        return isset($_SESSION['uid'])
            && $_SESSION['uid'] > 0;
    }

    protected function isAdm() {
//        return true;
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

    /**
     * @param $token
     * @param $expire
     */
    protected function setAssessToken($token,$expire) {
        /*$timeRemain = (int)$expire - 3*60*60;

        // 如果access_token可用时间少于3小时 那么就注销
        if ($timeRemain<3*60*60) {
            //
        }*/

        setcookie('at',$token,$expire);
    }

    /**
     * @param bool $useCookie 是否采用cookie
     * @param string $code 易班回调的code
     * @return array
     */
    protected function getAssessToken($useCookie = true,$code = '') {
        $user = $this->getUser();
        return $user['token'];

        return $_COOKIE['at'];
        if ($useCookie && $_COOKIE['at']) {
            return $_COOKIE['at'];
        }
        else {
            import('@.Behavior.https');

            $args = array(
                'client_id'     =>  C('YB_APP_ID'),     //必填	应用appkey
                'client_secret'  =>  C('YB_APP_SEC'),	//必填	应用appsecret
                'code'          =>  $code,	        //必填	已授权的令牌
                'redirect_uri'  =>  C('YB_CB_URL'),	//必填	应用回调地址
            );
            $https = new https('https://openapi.yiban.cn/oauth/access_token',$args,https::POST);

            $res = null;
            try {
                $res = json_decode($https->getResponseTxt(),true);
            }
            catch (Exception $e) {
                return array('status'=>false,'info'=>$e->getMessage());
            }
            if ($res['access_token']) {
                //dump($res);//e4426222cabb32e29cefe350e9c95faf40c2250c
                //dump(date('Y-m-d H:i:s',$res['expires']));
                //进行缓存操作
                //返回数据
                return array('status'=>true,'assessToken'=>$res['access_token'],'expire'=>$res['expires'],'yb_userid'=>$res['expires']);
            }
            else {
                //code 错误号码
                //msgCN 中文提示
                //msgEN 英文提示
                //dump($res);//e4426222cabb32e29cefe350e9c95faf40c2250c
                return array('status'=>false,'info'=>$res['msgCN'],'code'=>$res['code']);
            }
        }
    }

    /**
     * CKEDITOR 上传图片返回base64的页面
     */
    public function ckUploadImg() {
        if ($_GET['CKEditorFuncNum'])
            $CKEditorFuncNum = $_GET['CKEditorFuncNum'];//返回的回调函数的对应号码
        else
            exit("非法请求");
        //上传文件
        $upload = $_FILES['upload'];
        $allow = array(
            "image/png",
            "image/jpeg",
            'image/gif'
        );

        // 是否存在上传错误
        if ($upload['error'])
            $this->ckdeitorIframeCallback($CKEditorFuncNum,"文件上传时出错,错误代码: ".$upload['error']);

        // 判断文件类型
        if (!in_array($upload['type'],$allow))
            $this->ckdeitorIframeCallback($CKEditorFuncNum,"不允许的文件类型");

        // 判断文件大小,图片大小不超过1M
        if ($upload['size'] >= C('MAX_UPLOAD_SIZE')*1024*1024)
            $this->ckdeitorIframeCallback($CKEditorFuncNum,"图片文件不超过1M");

        // 获取文件base64字符串
        $file = $this->imgToBase64($upload['tmp_name']);

        if (!$file)
            $this->ckdeitorIframeCallback($CKEditorFuncNum,"图片获取失败");

        $this->ckdeitorIframeCallback($CKEditorFuncNum,"上传成功",json_encode($file));
        return;
    }

    /**
     * @param $file string 文件路径
     * @return bool|string 结果或者base64字符串
     */
    private function imgToBase64($file) {
        $type=getimagesize($file);//取得图片的大小，类型等
        $fp=fopen($file,"r");
        if (!$fp) return false;
        $file_content=chunk_split(base64_encode(fread($fp,filesize($file))));//base64编码
        $img_type="";
        switch($type[2]){//判读图片类型
            case 1:$img_type="gif";break;
            case 2:$img_type="jpg";break;
            case 3:$img_type="png";break;
            default : return false;
        }
        fclose($fp);
        return 'data:image/'.$img_type.';base64,'.$file_content;//合成图片的base64编码
    }

    /**
     * @param $fn
     * @param $message
     * @param string $fileurl
     */
    private function ckdeitorIframeCallback($fn,$message,$fileurl = '') {
        //采用了base64之后不需要考虑存储位置
        //if (!empty($fileurl)) $fileurl = 'http://'.$_SERVER["HTTP_HOST"].'/'.$fileurl;
        $str = '<script type="text/javascript">'.
            'window.parent.CKEDITOR.tools.callFunction('.$fn.','.$fileurl.' , \''.$message.'\');'.
            '</script>';
        exit($str);
    }
}