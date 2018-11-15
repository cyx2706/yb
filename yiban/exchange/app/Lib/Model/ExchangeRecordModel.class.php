<?php
class ExchangeRecord extends MyModel  {
    protected $_validate = array(
        


//        array('exgid',),
//        array('num',),
//        数量大于0
//        array('num',),
    );

    protected $_auto = array(
        array('uid','getUid',Model::MODEL_INSERT,'callback'),
        array('time','getTime',Model::MODEL_INSERT,'callback'),
    );

}