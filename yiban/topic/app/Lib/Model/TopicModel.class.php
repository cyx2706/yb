<?php
class TopicModel extends MyModel {

    // 自动验证
    protected $_validate = array(

        // 字数限制
        //,0,Model:: MODEL_INSERT
         array('title', 'require', '你还没有写一句话概括呢~',Model::EXISTS_VALIDATE),

        // 字数限制
//         array('content', 'require', '您还没有'),

        // 不存在的字段,检验用户能否添加话题到数据库的验证规则
        // array('virtual', 'addPermission', '不允许刷屏', Model::MUST_VALIDATE, 'callback', Model:: MODEL_INSERT),
    );

    //array(填充字段,填充内容,[填充时间,附加规则])
    protected $_auto = array (
        array('uid','getUid',Model::MODEL_BOTH,'callback'),
        array('typeid','1'),

        // 防止脚本插入
        // array('content','htmlspecialchars',Model::MODEL_BOTH,'function'),

        array('addtime','getTime',Model::MODEL_INSERT,'callback'),
        array('updtime','getTime',Model::MODEL_BOTH,'callback'),
    );

    /*protected $uid = 0;

    public function setUid($id) {
        $this->uid = $id;
    }

    public function getUid() {
        return $this->uid;
    }*/

    public function getTime() {
        return date('Y-m-d H:i:s');
    }

}
?>