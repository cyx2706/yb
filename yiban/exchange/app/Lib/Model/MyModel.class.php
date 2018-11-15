<?php
class MyModel extends Model {


    protected $uid = 0;

    public function setUid($id) {
        $this->uid = $id;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getTime() {
        return date('Y-m-d H:i:s');
    }

    /**
     * @var array 暂存数据
     */
    protected $_tmp;

    /**
     * 重写父类对象
     * @param string $data
     * @return mixed
     */
    public function create($data='') {
        // 必须在create之前记录所有变量
        $this->_tmp = empty($data) || !strlen($data) ?
            (isset($_POST) &&  !empty($_POST)? $_POST : $_GET)
            :$data;
        // 创建对象
        return parent::create($data);
    }
}
?>