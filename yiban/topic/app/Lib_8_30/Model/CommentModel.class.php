<?php
class CommentModel extends Model {

    private $img = null;

    public $imgid = 0;

    private $isUploadSuccess = false;

    protected $_validate = array();

    public function __construct() {

        parent::__construct();

        // 如果有上传文件就检验
        if (isset($_FILES) && !empty($_FILES) && count($_FILES) > 0){

            $this->img = $_FILES['img'];

            $this->_validate = array(
                array('virtual_field_img', 'isUploadFile', '您的网络不稳定,图片上传发生错误,请重新上传', Model::MUST_VALIDATE, 'callback', Model:: MODEL_INSERT),
                array('virtual_field_img', 'checkUploadStatus', '您的网络不稳定,图片上传发生错误,请重新上传', Model::MUST_VALIDATE, 'callback', Model:: MODEL_INSERT),
                array('virtual_field_img', 'checkUploadSize', '图片太大了,不能超过'.C('MAX_UPLOAD_SIZE').'M', Model::MUST_VALIDATE, 'callback', Model:: MODEL_INSERT),
                array('virtual_field_img', 'checkUploadMIME', '只允许上传:jpg、png、gif三种类型的图片', Model::MUST_VALIDATE, 'callback', Model:: MODEL_INSERT),
                array('virtual_field_img', 'checkUploadExt', '只允许上传:jpg、png、gif三种类型的图片', Model::MUST_VALIDATE, 'callback', Model:: MODEL_INSERT),
                array('virtual_field_img', 'UploadSuccess', '图片上传发生错误,请重新上传', Model::MUST_VALIDATE, 'callback', Model:: MODEL_INSERT),
                );
        }

        $this->_validate[] =
            array('content','checkContent','您什么都没写哦,写点什么吧~', Model::MUST_VALIDATE, 'callback', Model:: MODEL_INSERT);
    }


    /**
     * 检验上传文件是否为上传文件
     * @return bool
     */
    public function isUploadFile() {
        return is_uploaded_file($this->img['tmp_name']);
    }

    /**
     * 默认上传的error为0,表示没有错误
     * @return bool
     */
    public function checkUploadStatus() {
        return ! $this->img['error'];
    }

    /**
     * 检验文件的大小
     * @return bool
     */
    public function checkUploadSize() {
        return $this->img['size'] <= C('MAX_UPLOAD_SIZE')*1024*1024;
    }


    /**
     * 检验文件的MIME类型
     * @return bool
     */
    public function checkUploadMIME() {
        return ($this->img["type"] == "image/gif")
            || ($this->img["type"] == "image/jpeg")
            || ($this->img["type"] == "image/png")
            || ($this->img["type"] == "image/pjpeg");
    }

    /**
     * 检验文件的后缀名
     * @return bool
     */
    public function checkUploadExt() {
        $filePath = explode('.',$this->img['name']);

        $this->img['ext'] = $ext = strtolower($filePath[count($filePath)-1]);
        //echo json_encode(array('data'=>0,'info'=>$this->img['ext'],'status'=>0));
        //exit;
        return ($ext == 'jpg')
            || ($ext == 'png')
            || ($ext == 'gif');
    }

    /**
     * 执行上传操作,返回状态
     * @return bool
     */
    public function UploadSuccess() {
        if (!is_dir(C('UPLOAD_PATH'))) {
            mkdir(C('UPLOAD_PATH'),0777,true);
        }
        // 路径/文件hash值.后缀名
        $path = C('UPLOAD_PATH').md5($this->img['name'].$this->img['size'].$this->uid).'.'.$this->img['ext'];
        if (move_uploaded_file($this->img['tmp_name'],$path)) {
            $this->imgid = M('Img')->add(array(
                'uid'       => $this->uid,
                'src'       => $path,
                'addtime'   => date('Y-m-d H:i:s')
            ));
        }
        return ($this->isUploadSuccess = $this->imgid > 0);
    }

    /**
     * 初步检验content是否可行
     * @param $content
     * @return bool
     */
    public function checkContent($content) {
        // 如果没有上传任何文件,content不能为空
        if ($this->img === null) {
            return $content !== "";
        }
        else {
            return $this->isUploadSuccess;
        }
    }

    //array(填充字段,填充内容,[填充时间,附加规则])
    protected $_auto = array (

        array('uid','getUid',Model::MODEL_BOTH,'callback'),

        // 防止sql注入
        array('tid','intval',Model::MODEL_BOTH,'function'),

        // 防止sql注入
        array('touid','intval',Model::MODEL_BOTH,'function'),

        // 防止脚本插入
        array('content','htmlspecialchars',Model::MODEL_BOTH,'function'),

        // 获取上传的图片id
        array('imgid','getImgId',Model::MODEL_BOTH,'callback'),

        array('addtime','getTime',Model::MODEL_INSERT,'callback'),
    );

    protected $uid = 0;

    /**
     * @param $id
     */
    public function setUid($id) {
        $this->uid = $id;
    }

    /**
     * @return int
     */
    public function getUid() {
        return $this->uid;
    }

    /**
     * 获取图片id,默认为0
     * @return int
     */
    public function getImgId() {
        return $this->imgid;
    }

    /**
     * @return false|string
     */
    public function getTime() {
        return date('Y-m-d H:i:s');
    }


}
?>