<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'               => 'mysql',     // 数据库类型
    'DB_HOST'               => '182.254.227.95',//'42.96.147.217', // 服务器地址
    'DB_NAME'               => 'yiban',       // 数据库名
    'DB_USER'               => 'yiban',      // 用户名
    'DB_PWD'                => 'cyx_2017_7_2',//'muyuchengfeng',          // 密码
    'DB_PORT'               => 3306,        // 端口
    'DB_PREFIX'             => NULL,		    // 数据库表前缀
    'DB_SUFFIX'             => NULL,      // 数据库表后缀


    //自定义的
    'YB_APP_ID'     => 'bef6c8668054339e',
    'YB_APP_SEC'    => '05c14ab2114901e664d1702619356713',
    'YB_APP_CB_URL' => 'http://120.24.45.27/yiban/stuGrade.php',

    'START_YEAR'    => 2017,
    'END_YEAR'      => 2018,
    'TERM'          => 2,

    // 压缩输出,加快加载速度
    'OUTPUT_ENCODE'         => true,
);
?>