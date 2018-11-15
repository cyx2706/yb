<?php
return array(
    //'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               => 'mysql',     // 数据库类型
    'DB_HOST'               => '127.0.0.1',//'42.96.147.217', // 服务器地址
    'DB_NAME'               => 'yiban',       // 数据库名
    'DB_USER'               => 'root',      // 用户名
    'DB_PWD'                => 'root',  //'muyuchengfeng',          // 密码
    'DB_PORT'               => 3306,        // 端口
    'DB_PREFIX'             => NULL,		    // 数据库表前缀
    'DB_SUFFIX'             => NULL,      // 数据库表后缀

    // URL 重写模式
    'URL_MODEL'             => 2,


    //自定义的
    'YB_APP_ID'             => 'cfe93939553b7fed',
    'YB_APP_SEC'            => '5c98300de018125aa61413ddfa82c60b',
    'YB_LOGIN_STATE'        => 'Hi',
    'YB_CB_URL'             => 'http://www.quickprint.net.cn/yiban/topic/Login/usr.html',

    'SERVER_ROOT'           => 'http://www.quickprint.net.cn/yiban/topic',
    'SERVER_URI'            => 'http://www.quickprint.net.cn',

    // 是否需要实名制
    'REAL_NAME_REG'         => false,

    'TOPIC_NUM_A_PAGE'      => 10,      //每次加载10条话题
    'CMMNT_NUM_A_PAGE'      => 10,      //每次加载10条评论

    'MAX_UPLOAD_SIZE'       => 1,       //最多上传尺寸 单位M
    'UPLOAD_PATH'           => APP_PATH.'upload/',//上传目录

    'TMPL_PARSE_STRING'     => array(
        '__PUBLIC__'    => APP_PATH.'../../../../'.'Public',
    ),

    'OUTPUT_ENCODE'         => true,
);
?>