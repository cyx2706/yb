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
}
?>