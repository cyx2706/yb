<?php
return array(

    /*调试*/
//    'SHOW_ERROR_MSG'        => true, //是否显示错误信息
//    'SHOW_PAGE_TRACE'       => true, // 显示页面Trace信息
//    'APP_STATUS'            => 'debug', //应用调试模式状态


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

    // URL 重写模式 设置为兼容模式
    'URL_MODEL'             => 3,


    //自定义的
    'YB_APP_ID'             => '8a98d1eeca4b0af3',
    'YB_APP_SEC'            => 'cf1f471ccdee25fc31f3e206c6b88e43',

    'YB_LOGIN_STATE'        => 'EXCH',
    'YB_CB_URL'             => 'http://www.gdpuyiban.com/exchange',

    'SERVER_ROOT'           => 'http://www.gdpuyiban.com/exchange',
    'SERVER_URI'            => 'http://www.gdpuyiban.com',

    // 是否为设备维护
    'APP_MAINTENANCE'       => false,

    // 特殊兑换物品的id号
    'SPCL_GIFT_ID'          => array(
	// 女子健身
        'GIRL_SPORT'    => 12,
        'BREAKFAST1'    => 13,
        'BREAKFAST2'    => 14,
    ),

//    'TOPIC_NUM_A_PAGE'      => 10,      //每次加载10条话题
//    'CMMNT_NUM_A_PAGE'      => 10,      //每次加载10条评论

    'MAX_UPLOAD_SIZE'       => 1,       //最多上传尺寸 单位M
    'UPLOAD_PATH'           => APP_PATH.'upload/',//上传目录

    'TMPL_PARSE_STRING'     => array(
        '__PUBLIC__'    => APP_PATH.'../../../../'.'Public',
    ),

);
?>
