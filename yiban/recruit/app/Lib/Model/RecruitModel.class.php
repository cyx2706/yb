<?php
class RecruitModel extends Model {
    protected $_validate = array(
        // 验证码
        //array('verify','require','请填写好验证码哦',Model::MUST_VALIDATE,'',Model::MODEL_INSERT),

        // 学院不为空
        array('college','require','您还没有填写学院名称哦~',Model::MUST_VALIDATE,'',Model::MODEL_INSERT),

        // 班级不为空
        array('class','require','您还没有填写班级哦',Model::MUST_VALIDATE,'',Model::MODEL_INSERT),

        // 姓名不为空
        array('name','require','您还没有填写姓名哦',Model::MUST_VALIDATE,'',Model::MODEL_INSERT),

        // 必须要写电话
        array('phone','require','您还没有填写联系电话哦',Model::MUST_VALIDATE,'',Model::MODEL_INSERT),
        // 每个电话号码作为标识
        array('phone','','该手机号码已经被提交过了,如果您想修改的话,可以到我们摊位重新写一份哦~',Model::MUST_VALIDATE,'unique',Model::MODEL_INSERT),

        // 部门不能为空
        array('depart','arrayNotNull','您还没有选择部门哦',Model::MUST_VALIDATE,'callback',Model::MODEL_INSERT),

    );

    protected $_auto = array(
        array('depart','json_encode',Model::MODEL_INSERT,'function'),
    );

    public function arrayNotNull($arr) {
        return is_array($arr) ? count($arr) : false;
    }

}
?>