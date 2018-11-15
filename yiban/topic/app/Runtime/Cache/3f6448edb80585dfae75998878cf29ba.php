<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hi</title>
    
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">

<!-- jQuery -->
<script src="__PUBLIC__/js/jquery-2.2.0.js"></script>

<!-- Compiled and minified JavaScript -->
<script src="__PUBLIC__/js/materialize.min.js"></script>
<style>

    /* fallback */
    @font-face {
        font-family: 'Material Icons';
        font-style: normal;
        font-weight: 400;
        src: url(__PUBLIC__/fonts/2fcrYFNaTjcS6g4U3t-Y5ZjZjT5FdEJ140U2DJYC3mY.woff2) format('woff2');
    }

    .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
    }


    html,body {
        height: 100%;
    }
    body {
        background-color: #fcfcfc;
        background-color: #efebe9;
        background-color: #f8f8f8;
    }

    .main-bg-color {
        background-color: #ee6e73;
    }

    .none-box-shadow {
        -moz-box-shadow: none;
        -webkit-box-shadow:none;
        box-shadow:none;
    }

    .overflow-hidden {
        overflow: hidden;
    }

    .brand-logo {
        /*PC端*/
        padding: 0 30px;
    }

    a {
        cursor: pointer;
    }


    .card .card-title {
        font-size: 18px;
    }

    .swiper-container,.swiper-slide,.swiper-wrapper,.page-wrapper {
        height: 100%;
    }

    .swiper-slide {
        overflow-y: auto
    }

    .border-box {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .content-box {
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
    }
    .break-word {
        word-wrap:break-word;
    }


    .page-wrapper {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        display: none;
        position: relative;
    }

    .loading {
        padding-top: 2px;
    }

    .tranX-50 {
        transform: translateX(-50%);
    }
    .tranY-50 {
        transform: translateY(-50%);
    }
    .public-nick {
        color: #ffab40;
    }
</style>
</head>
<style>
    @media only screen and (min-width: 992px)
    {
        #homePage .tab-wrapper {
            margin: 20px 10% 0;
        }
    }

    #homePage .tab-wrapper {
        position: relative;
        padding: 0 7px 60px 7px;
    }



    #homePage .loading {
        position: absolute;
        left:50%;
        bottom: 10px;
        transform: translateX(-50%);
        display: none;
    }

    #homePage #edit-btn {
        position: absolute;
        bottom: 20px;
        right: 20px;
    }

    #homePage .brief .nick {
        margin-left: 50px;
    }


    #homePage .brief .brief-top {
        position: relative;
        height: 40px;
        padding-bottom: 20px;
    }



    #homePage .brief p {

        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    #homePage .brief .brief-title {
        /*cursor: pointer;*/
        color: rgba(0,0,0,0.87);
    }
</style>
<style>
    .editor {
        height: 100%;
        display: none;
    }
    #lives-editor .main-edit-area{
        height: 200px;
    }
    .edit-area {
        width: 100%;
        height: auto;
        padding: 10px;
    }


    /* label color */
    .main-bg-color .input-field label {
        color: #eeeeee;
    }

    /* label underline color */
    .main-bg-color .input-field input,
    .main-bg-color .input-field textarea {
        border-bottom: 1px solid #eeeeee;
        color: #ffffff;
    }

    /* label focus color */
    .main-bg-color .input-field input[type=text]:focus + label,
    .main-bg-color .input-field textarea:focus + label {
        color: #fff;
    }

    /* label underline focus color */
    .main-bg-color .input-field input[type=text]:focus,
    .main-bg-color .input-field textarea:focus
    {
        border-bottom: 1px solid #fff;
        box-shadow: 0 1px 0 0 rgba(255,255,255,0.5);
    }

    /* valid color */
    .main-bg-color .input-field input[type=text].valid,
    .main-bg-color .input-field textarea.valid {
        border-bottom: 1px solid #fff;
        box-shadow: 0 1px 0 0 #fff;
    }
    /* invalid color */
    .main-bg-color .input-field input[type=text].invalid,
    .main-bg-color .input-field textarea.invalid {
        border-bottom: 1px solid orangered;
        box-shadow: 0 1px 0 0 orangered;
    }
    /* icon prefix focus color */
    .main-bg-color .input-field .prefix.active {
        color: #fff;
    }
    .main-bg-color .character-counter {
        color: #fff;
    }
    .main-bg-color .input-field{
        margin-bottom: 20px;
    }




    /* 上传环境 */
    .upload-area {
        width: 100%;
        overflow: hidden;
        zoom: 1;
    }
    .uploader-wrapper {
        float: left;
        padding: 20px;
        position: relative;
    }
    .del-img {
        position: absolute;
        height: 20px;
        width: 20px;
        right: 5px;
        top: 5px;
        line-height: 20px;
        font-weight: bold;
        text-align: center;
    }

    /* 上传相关 */
    .uploader {
        display: block;
        position: relative;
        height: 80px;
        width: 80px;
        border: 1px solid #eeeeee;
        box-sizing: content-box
    }
    .uploader>input {
        display: none;
    }
    .uploader:before {
        content: " ";
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
        background-color: #eeeeee;
        width: 2px;
        height: 40px;
    }
    .uploader:after {
        content: " ";
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
        background-color: #eeeeee;/*#d9d9d9;*/
        width: 40px;
        height: 2px;
    }
    .uploader:active {
        border: 1px solid #d9d9d9;
    }
    .uploader:active:after {
        background-color: #d9d9d9;
    }
    .uploader:active:before {
        background-color: #d9d9d9;
    }
</style>
<style>
    @media only screen and (min-width: 992px)
    {
        #detailPage .tab-wrapper {
            margin: 20px 10% 0;
        }
    }
    .tab-wrapper {
        padding: 0 7px;
    }

    #detailPage .comment-wrapper {
        overflow: hidden;
        zoom:1;
        padding : 15px 0;
    }
    .comment-wrapper+.comment-wrapper{
        border-top: 1px solid #eeeeee;
    }

    .comment-wrapper .comment-userhead-wrapper {
        background-color: #eeeeee;
        float: left;
        width: 50px;
        height: 50px;margin-right: 5%;
    }

    .comment-wrapper .comment-nick-wrapper {
        overflow: hidden;
        zoom: 1;
    }
    .comment-wrapper .comment-nick-wrapper .nick{
        width: 50%;
        float: left;
    }

    .comment-wrapper .comment-userhead {
        height: 100%;width: 100%;
    }

    .comment-img-wrapper img{
        max-height: 80px;
        max-width: 80px;
    }
</style>
<body>
<!-- 主页 -->
<div id="homePage" class="page-wrapper" data-hash-page="home" data-loader="HomeLoad">
    <nav class="nav-extended none-box-shadow">
    <!--tabs-->
    <div class="nav-content">
        <ul class="tabs tabs-transparent overflow-hidden">
            <!--class="active" -->
            <li class="tab"><a href="#yiban" data-module="yiban">易班栏目</a></li>
            <li class="tab"><a href="#lives">更多<!--<span class="new badge"></span>--></a></li>
        </ul>
    </div>
</nav>
<div id="tab-wrappers">

    <!-- 易班官方话题 -->
    <div id="yiban" class="tab-wrapper">

        <script id="yibanBriefTpl" type="text/html">
            <div class="card none-box-shadow brief" data-tid="{{tid}}">
                <div class="card-content">

                    <div class="brief-top">
                        <span style="position: absolute;top: 0;left: 0">
                            <img src="{{yb_userhead}}" style="width: 40px;height: 40px;border-radius:20px;"/>
                        </span>
                        <span class="nick">
                            <font style="line-height: 40px;">{{nick}}</font>
                        </span>
                        <span class="right" style="color: #999999">
                            <font class="brief-time" style="line-height: 40px;">{{updtime}}</font>
                        </span>
                    </div>

                    <!-- 标题 -->
                    <a class="card-title brief-title" href="#detail/topic/{{tid}}">{{title}}</a>
                    <p class="brief-content">{{content}}</p>
                </div>
            </div>
        </script>


        
<!-- 加载中 -->
<div class="btn-floating btn white loading">
    <div class="preloader-wrapper small active">
        <div class="spinner-layer">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
            <div class="circle"></div>
        </div><div class="circle-clipper right">
            <div class="circle"></div>
        </div>
        </div>
    </div>
</div>

    </div>

    <!-- 更多 -->
    <div id="lives"  class="tab-wrapper">
        <div class="center-align" style="padding: 50px;">功能正在测试中,敬请期待~</div>

        <?php  ?>

    </div>


    <!-- 编辑按钮 -->
    <?php  ?>
</div>

</div>

<!-- 文章 -->
<div id="detailPage" class="page-wrapper" data-hash-page="detail" data-loader="DetailLoad">
    <div class="navbar-fixed" style="height: 50px;">
    <nav class="nav-extended none-box-shadow overflow-hidden">
        <!--tabs-->
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <!-- class="active" -->
                <li class="tab"><a data-location="#content">详情</a></li>
                <li class="tab"><a data-location="#comments">评论</a></li>
            </ul>
        </div>
    </nav>
</div>



<div class="tab-wrapper">

    <!-- 阅读区 -->
    <div id="content" class="card none-box-shadow">

        <div class="card-content">
            <?php  ?>
            <script type="text/html" id="showTopicTpl">
                <!-- 标题 -->
                <div class="card-title center-align">{{title}}</div>
                <!-- 正文内容 -->
                <p class="break-word">{{content}}</p>
            </script>
        </div>

    </div>

    <!--热门评论区-->
    <div id="hot-comments" class="card none-box-shadow" style="display: none">
        <div class="card-content">

            <div class="right-align" style="color: #999999">
                热门评论
            </div>

            <!-- 评论区 -->
            <div class="comment-wrappers" style="padding-bottom: 20px;"></div>
        </div>

    </div>


    <!-- 评论区 -->
    <div id="comments" class="card none-box-shadow" style="display: none">
        <div class="card-content">

            <div class="right-align">
                <a id="flush-comments">
                    <i  class="tiny material-icons">loop</i>
                    刷新评论
                </a>
            </div>

            <!-- 评论区 -->
            <div class="comment-wrappers" style="padding-bottom: 20px;"></div>

            <div class="center-align" id="nomore-comments" style="width: 100%;display: none;">就只有这么多评论了...</div>

            <!-- 加載中模板 -->
            <span id="comments-loading" style="margin-left: 50%;position: relative;">
                <div  class="tranX-50" style="position: absolute;left:50%;top:-15px;">
                <div class="preloader-wrapper small active">
                    <div class="spinner-layer">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                    </div>
                </div>
                </div>
            </span>


        </div>
    </div>

</div>

<?php  ?>


<!-- 编辑按钮 -->
<div class="fixed-action-btn">
    <a id="edit-comment-btn" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">mode_comment</i></a>
</div>



<?php  ?>
<script type="text/html" id="commentTpl">
    <div class="comment-wrapper" data-commentid="{{cmid}}">

        <!--头像-->
        <div class="comment-userhead-wrapper">
            <img class="comment-userhead" src="{{yb_userhead}}"/>
        </div>

        <!-- 用户昵称 -->
        <div class="comment-nick-wrapper">
            <span class="nick truncate">{{nick}}</span>

            <?php  ?>

            <?php if($isAdm): ?><span class="manage-comment-tools">
                                    <a class="recommend-comment"
                                       style="display: none">上墙</a>
                                    <a class="red-text recommend-cancel"
                                       style="display: none">取消</a>
                                    |
                                    <a class="block-comment"
                                       style="display: none">屏蔽</a>

                                    <a class="red-text show-comment"
                                       style="display: none">显示</a>
                                </span><?php endif; ?>
        </div>

        <!-- 内容 -->
        <div class="comment-content" style="background-color: #eeeeee;float: left;width: 70%;position: relative;padding: 10px;">

            <!-- 三角形 -->
            <p style="
                    position: absolute;
                    border: 8px solid #eeeeee;
                    top: 5px;left: -16px;

                    border-top: 8px transparent solid;
                    border-bottom: 8px transparent solid;
                    border-left: 8px transparent solid;
                    "></p>
            <!-- 评论内容 -->
            <div>
                {{content}}
            </div>

            <!-- 图片 -->
            <div class="comment-img-wrapper">
                <img src="{{src}}"/>
            </div>
        </div>

        <!-- 其他 -->
        <div class="left right-align comment-tools" style="width: 100%;margin-top: 5px;">
            <span class="comment-time">{{addtime}}</span>
        </div>
    </div>
</script>
</div>

<!-- 编辑 -->
<div id="editPage" class="page-wrapper" data-hash-page="edt" data-loader="EditLoad">

    <?php  ?>
    <?php if($isLogin == 1): ?>

<!-- 发布评论 -->
<div id="comment-editor" class="editor">
    <form>
        <!-- 详细叙述 -->
        <div class="edit-area main-bg-color">
            <div class="input-field">
                <textarea name="content" data-length="300" id="comment-content-editor" class="materialize-textarea"></textarea>
                <label for="comment-content-editor">期待您精彩的评论~</label>
            </div>
            <span>
            <input type="hidden" name="tid"/>
            <input type="hidden" name="lid"/>
            </span>
            <input type="hidden" name="touid"/>

        </div>

        <!-- 文件上传区域 -->
        <div class="edit-area">
            <div class="file-field input-field left" style="width: 90%">
                <div class="btn">
                    <span>来一张表情包?</span>
                    <input type="file" name="img" accept="image/*"/>
                </div>
                <div class="file-path-wrapper">
                    <input placeholder="大小不能超过<?php echo C('MAX_UPLOAD_SIZE');?>M" class="file-path validate" type="text"/>
                </div>
            </div>

            <span class="file-field input-field left" style="position: relative;width: 10%">
                <span class="btn-floating btn-small del-img red upload-cancel">×</span>
            </span>
        </div>
    </form>

</div>

<?php  ?>

<!-- 提交 -->
<div class="fixed-action-btn">
    <a id="edit-sub"  class="btn-floating btn-large waves-effect waves-light"><i class="material-icons right">send</i></a>
</div>
        <?php else: ?>
        <form style="display: none" action="https://openapi.yiban.cn/oauth/authorize" method="get">
    <input name="client_id" value="<?php echo C('YB_APP_ID');?>"/>
    <input name="redirect_uri" data-url="<?php echo C('SERVER_URI'); echo U('Login/usr');?>"/>
    <input name="state" data-val="<?php echo C('YB_LOGIN_STATE');?>"/>
</form><?php endif; ?>

</div>
</body>
<script>
    (function ($) {
        $.extend({

            /**
             * 获取hash字符串
             * @return string hash
             */
            getHash     : function () {
                var _hash = location.hash.replace('#','');
                return _hash ? _hash : '';
            },

            /**
             * @return string hash[0]
             */
            getHashRoot : function () {
                return $.getHash().split('/')[0];
            },

            /**
             * @example #a/b/c return ['a','b','c']
             * @return Array
             */
            getHashArr  : function () {
                return $.getHash().split('/');
            },

            /**
             * 获取模板
             * @param selector string
             * @param save boolean
             * @return str 模板内容
             */
            getTpl      : function (selector,save) {
                var tpl = $(selector).html();
                if (! save ) {      $(selector).remove(); }
                return tpl;
            },

            /**
             * 编译模板
             * @param tpl string
             * @param obj {*}
             * @return str 编译之后的模板
             */
            compile     : function (tpl,obj) {
                var bindVars = tpl.match(/[{][{][^{}]+[}][}]/g);
                $.each(bindVars,function (j,bindVar) {
                    var key = $.trim(bindVar.replace(/[{}]/g,''));
                    tpl = tpl.replace(bindVar,obj[key]);
                });
                return tpl;
            },

            getDateTimeStamp    : getDateTimeStamp,

            getDateDiff         : getDateDiff,
        });


        /**
         * 将日期字符串转换为时间戳
         * @param dateStr 时间字符串
         * @return {number}
         */
        function getDateTimeStamp (dateStr) {
            return Date.parse(dateStr.replace(/-/gi,"/"));
        }

        /**
         * 获取时间间距
         * @param dateStr 日期字符串
         * @return string 间距字符串
         */
        function getDateDiff (dateStr) {
            var publishTime = getDateTimeStamp(dateStr)/1000,
                    d_seconds,
                    d_minutes,
                    d_hours,
                    d_days,
                    timeNow = parseInt(new Date().getTime()/1000),
                    d,

                    date = new Date(publishTime*1000),
                    Y = date.getFullYear(),
                    M = date.getMonth() + 1,
                    D = date.getDate(),
                    H = date.getHours(),
                    m = date.getMinutes(),
                    s = date.getSeconds();
            //小于10的在前面补0
            if (M < 10) {
                M = '0' + M;
            }
            if (D < 10) {
                D = '0' + D;
            }
            if (H < 10) {
                H = '0' + H;
            }
            if (m < 10) {
                m = '0' + m;
            }
            if (s < 10) {
                s = '0' + s;
            }

            d = timeNow - publishTime;
            d_days = parseInt(d/86400);
            d_hours = parseInt(d/3600);
            d_minutes = parseInt(d/60);
            d_seconds = parseInt(d);

            if(d_days > 0 && d_days <= 7){
                return d_days + '天前';
            }else if(d_days <= 0 && d_hours > 0){
                return d_hours + '小时前';
            }else if(d_hours <= 0 && d_minutes > 0){
                return d_minutes + '分钟前';
            }else if (d_seconds < 60) {
                if (d_seconds <= 0) {
                    return '刚刚';
                }else {
                    return d_seconds + '秒前';
                }
            }else if (d_days >= 3 && d_days < 30){
                return M + '-' + D + ' ' + H + ':' + m;
            }else if (d_days >= 30) {
                return Y + '-' + M + '-' + D + ' ' + H + ':' + m;
            }
        }

        $.fn.extend({

            loadMore : function (config) {
                var scrollTop = $(document).scrollTop();
                var _isActive = (config.isActive ? config.isActive() : false);
                var _More = ! $(config.selector).data('noMore');
                var _ajaxActive = ! $(config.selector).data('ajaxActive');

                // 如果当前页是活动状态
                if (_isActive
                        // 并且还没加载完
                        && _More
                        // 当前没有进行请求
                        && _ajaxActive) {

                    // 设置ajax锁,防止多次请求
                    $(config.selector).data('ajaxActive' , true);

                    // 显示加载中
                    config.showLoading ? config.showLoading() : (function () { console.log('正在加载中...') })();

                    $.ajax({
                        url     : config.url,
                        type    : 'GET',
                        data    : $.extend(true,new function(){
                            this.page    = $(config.selector).data('pageCounter')+1;
                            if ($(config.selector).data('fstpk')) this.fst = $(config.selector).data('fstpk'); },config.args),
                        dataType: 'json',
                        cache   : false,
                        error   : function (xhr,status,error) {
                            config.error(error,xhr,status);
                        },
                        success : function (res,status,xhr) {
                            //TODO if (!res.status) config.error(error,xhr,status)
                            var appendObjs = res;

                            // 将每个数据根据模板规则插入到容器当中
                            $.each(appendObjs,function (i,appendObj) {

                                // 编译前数据处理
                                config.beforeCompile ?
                                        config.beforeCompile(i,appendObj)
                                        : null;

                                // 编译模板
                                var tpl = $.compile(config.template,appendObj);

                                // 插入dom
                                $(config.selector)[config.handle ? config.handle : 'append'](tpl);

                                // 插入之后的回调
                                config.appendCallback($(config.selector).children(':last'),i,appendObj);
                            });

                            // 滑动到之前保存的位置
                            $(document).scrollTop(scrollTop);

                            // 判断是否已经没有了,没有了的就不再加载
                            if (!appendObjs || appendObjs.length < config.maxLoadNum) {
                                // 不再加载
                                $(config.selector).data('noMore',true);

                                // 执行不再加载的回调函数
                                config.end ?
                                        config.end() : (function () { console.log('已经没有了,不再加载..'); })();
                            }
                            else if ( !$(config.selector).data('pageCounter') && config.pkName ) {
                                $(config.selector).data('fstpk', appendObjs[0][config.pkName]);
                            }

                            // 页数计算器+1
                            $(config.selector).data('pageCounter',   $(config.selector).data('pageCounter')+1);

                            // 解锁
                            $(config.selector).data('ajaxActive',   false);

                        },
                        complete: function (xhr,status) {

                            // 显示加载中
                            config.hideLoading
                                    ? config.hideLoading()
                                    : (function () { console.log('正在加载中...') })();

                            config.complete
                                    ? config.complete(xhr,status)
                                    : (function () { console.log('ajax完成') })();
                        },
                    });

                    return { result:true };
                } else {
                    return {
                        result : false,
                        log : {
                            _isActive:_isActive,
                            _More     :_More,
                            _ajaxActive:_ajaxActive
                        }
                    };
                }
            },

            /**
             * 用于page-wrapper类元素建立上拉加载更多的模型
             * @param config {*}
             * maxLoadNum                           最多加载元素的数量
             * isActive()                           表示当前页是否正处在活动状态的函数
             * showLoading()                        执行展示loading信息的函数,在ajax前调用
             * hideLoading()                        执行完成之后调用的函数,关闭loading
             * selector                             必选 $(config.selector)[config.handle](template);
             * template | templateId                必选 插入元素的模板
             * handle                               可选 默认是append
             * pkName                               可选 主键名称
             * calls Array                          必选 回调函数
             * end()                                可选 已经加载完之后的回调函数
             *
             * url                                  必选 ajax的url
             * args {*}                             可选 ajax的其他参数
             * error(error,xhr,status)              必选 ajax的错误处理函数
             * beforeCompile(i,appendObj)           可选 编译之前的数据处理函数
             * appendCallback($newItem,i,appendObj) 可选 插入每个新元素的回调函数
             * complete(xhr,status)                 可选 完成所有动作的函数
             */
            buildLoadMoreModel : function (config) {
                $(this).each(function () {
                    // 是否已经加载完毕
                    $(config.selector).data('noMore',       false);

                    // 是否正在执行ajax
                    $(config.selector).data('ajaxActive',   false);

                    // 表示已经加载到第几页,默认就是0
                    $(config.selector).data('pageCounter',   0);

                    // 记录第一个主键id的值
                    if (config.pkName) $(config.selector).data('fstpk',   -1);

                    // 寻找模板
                    config.template = !config.template && config.templateId
                            ? $.getTpl('#'+config.templateId)
                            : config.template;

                    var $this = $(this);

                    // 执行所有回调
                    $.each(config.calls,function (i,call) {
                        // 成为临时函数
                        $.fn.extend({ _tmp : call });
                        // 执行临时函数
                        $this._tmp(function () {   return $this.loadMore(config);  });
                    });
                });
                return $(this);
            },
        });
    })(jQuery);

</script>
<!-- home js -->
<script type="text/javascript">

    (function($) {
        var module = '';

        HomeLoad = function(mdl) {
            // 其他页面保证跳转时锚点正确即可
            if ( !module.length) {
                module = $.getHashArr()[1];
                if (module == 'lives') {
                    $("#homePage .tab a[href='#lives']").click();
                }
                else {
                    $("#homePage .tab a[href='#yiban']").click();
                    module = 'yiban';
                }
            }
            console.log('HomeLoad');

        };

       /**
        * error ajax的错误处理函数
        * appendCallback($newItem,i,appendObj) 插入每个新元素的回调函数
        * complete 完成所有动作的函数
        */
        $(document).ready(function () {

            var homePagefunction  = function(slctr,tplId,url,type) {
                // 设定选择器
                this.selector = slctr;

                this.maxLoadNum = parseInt("<?php echo C('TOPIC_NUM_A_PAGE');?>");

                // 设定模板id
                this.templateId = tplId;

                // 设定判断是否符合active状态判定函数
                this.isActive = function () {
                    return $("#homePage .tab a[href='"+slctr+"']").hasClass('active') && module == slctr.replace('#','');
                };

                // 展示loading信息
                this.showLoading = function () {
                    $(slctr).css('padding-bottom','60px');
                    $(slctr).find('.loading').show();
                };
                // 展示loading信息
                this.hideLoading = function () {
                    $(slctr).css('padding-bottom','10px');
                    $(slctr).find('.loading').hide();
                };

                // ajax相关
                this.url = url;

                // 易班话题还是生活圈
                this.args = {type : type};

                // 设定回调
                this.calls = [
                    // 当滑动到底部时自动执行
                    function (execute) {
                        var _hash = $(this).data('hash-page');
                        $(window).scroll(function () {
                            var scrollTop = $(document).scrollTop();

                            // 如果当前页是活动状态
                            if ($.getHashRoot() == _hash) {
                                // 是否已经滑动到页面底部
                                if ($(document).height() - $(window).height() - scrollTop <= 0) {
                                    // 并且执行成功
                                    var exec = execute();
                                    if (exec.result) {
                                        console.log('滑动到底部加载...'+slctr, exec.log);
                                    }
                                }
                            }
                        });
                    },

                    // 当tab被点击时,并且没有加载过的时候执行
                    function (execute) {
                        $("#homePage .tab a[href='"+slctr+"']").click(function () {
                            // 改变模块
                            module = slctr.replace('#','');

                            // 执行初始化
                            var exec = function() {
                                if ( $(slctr).data('pageCounter') < 1 ) {
                                    var exc = execute();
                                    if (exc.result) {
                                        console.log('被点击,而且之前没有加载过');
                                    }
                                    else {
                                        console.log('执行失败',exc.log);
                                    }
                                }
                            };
                            if ($(this).hasClass('active')) {
                                exec();
                            }
                            else {
                                setTimeout(exec,10);
                            }
                        });
                    }
                ];

                // ajax错误的回调
                this.error = function (xhr,status,error) {
                    console.log('ajax错误',arguments);
                };
                
                // 每个元素插入之后的回调
                this.appendCallback = function ($newItem,i,appendObj) {
                    if (parseInt(appendObj.status) > 1) {
                        $newItem.find('.nick').addClass('public-nick');
                        $newItem.find('.brief-time').text($.getDateDiff(appendObj.updtime));
                    }
                    // console.log(appendObj);
                };

                // 无论是success还是error都会执行的
                this.complete = function (xhr,status) {
                    console.log('关闭loadding');
                }
            };


            $('#homePage')
                    .buildLoadMoreModel(new homePagefunction('#yiban','yibanBriefTpl',"<?php echo U('Home/load');?>",1))
//                    .buildLoadMoreModel(new homePagefunction('#lives','livesBriefTpl',"<?php echo U('Home/load');?>",2));


        });
    })(jQuery);



</script>

<?php  ?>
<?php if($isLogin == 1): ?><!-- edit js -->
    <script>
    (function ($) {
        var module = '';
        EditLoad = function() {
            var _hashArr  = $.getHashArr();
            module = _hashArr[1];
            $("#editPage .editor").hide();
            var moduleWrapper = "#editPage #"+module+"-editor";
            $(moduleWrapper).show();

            switch (module) {
                case 'topic':
                    switch (_hashArr[2]) {
                        case 'add':
                            $(moduleWrapper+" form").data('action',"<?php echo U('Topic/add');?>");
                            break;
                    }
                    break;

                case 'comment':
                    $(moduleWrapper+" form").data('action',"<?php echo U('Comment/add');?>");

                    // 如果是话题的话
                    switch(_hashArr[2]) {
                        case 'topic':
                            $(moduleWrapper+" form").find("input[name='tid']").val(_hashArr[3]);
                            break;
                        case 'lives':
                            $(moduleWrapper+" form").find("input[name='lid']").val(_hashArr[3]);
                            break;
                    }

                    // 生活圈不一样
                    break;

                case 'lives':
                    $(moduleWrapper+" form").data('action',"<?php echo U('Lives/add');?>");
                    break;
            }

            console.log('EditLoad');
        };

        $(document).ready(function () {

            var uploaderWrapperHTML =
                    '<div class="uploader-wrapper">' +
                    '<span class="btn-floating btn-small del-img red">×</span>' +
                    '<label class="uploader"></label>' +
                    '</div>';


            $(".edit-area .input-field input[type!='file'],.edit-area .input-field textarea")
                    .focus(function () {
                        $('#editPage #edit-sub').hide();
                        var $edit_area = $(this).closest('.edit-area').prevAll();
                        var scrollTop = 0;
                        $edit_area.each(function () {
                            scrollTop +=
                                    $(this).height()
                                    + parseInt($(this).css('padding-top').replace(/[^0-9]*/,''));
                                    + parseInt($(this).css('padding-bottom').replace(/[^0-9]*/,''));
                                    + parseInt($(this).css('margin-top').replace(/[^0-9]*/,''));
                                    + parseInt($(this).css('margin-bottom').replace(/[^0-9]*/,''));
                        });
                        $(document).scrollTop(scrollTop);
                    })
                    .blur(function () {
                        $('#editPage #edit-sub').fadeIn(500);
                    });

            $('#comment-editor .upload-cancel').click(function () {
                var fileInput = $("#comment-editor input[type='file']").get(0);
                // for IE, Opera, Safari, Chrome
                if (fileInput.outerHTML) {
                    fileInput.outerHTML = fileInput.outerHTML;
                } else { // FF(包括3.5)
                    fileInput.value = "";
                }
                // 清空显示的text input
                $("#comment-editor .file-path-wrapper input").val('');
            });


            var ajaxLock = false;
            $('#editPage #edit-sub').click(function () {

                var _form = $("#editPage #"+module+"-editor form");
                console.log(_form.data());
                Materialize.toast('正在提交中,稍等一下就好~', 2000);
                if ( !ajaxLock ) {
                    ajaxLock = true;
                    var formData = new FormData();

                    _form.find('input,textarea')
                            .filter(function () { return $(this).attr('name') }).each(function () {
                        var val;
                        if ($(this).attr('type') == 'file') {
                            val = $(this).get(0).files[0];
                            // 如果没有上传文件就不需要算入
                            if (!val) return;
                        }
                        else {
                            val = $(this).val();
                        }
                        formData.append($(this).attr('name'),val);
                    });

                    var editHash = $.getHash();

                    $.ajax({
                        url : _form.data('action'),
                        type : 'POST',
                        data : formData,
                        dataType:'json',
                        // jQuery不处理发送的数据
                        processData : false,
                        // 不设置Content-Type请求头
                        contentType : false,
                        success : function(obj) {
                            console.log(obj);
                            // 提示失败原因
                            if (obj.status == 0 || obj.status == false) {
                                Materialize.toast('<font class="red-text">'+obj.info+'</font>', 2000);
                            }
                            // 提交成功
                            else {
                                // 刷新评论
                                $('#flush-comments').click();

                                // 如果还在编辑页面,那么就回退
                                if (editHash == $.getHash()) {
                                    history.back();
                                }

                                // 提示成功
                                Materialize.toast('<font class="green-text">'+obj.info+'</font>', 2000);

                            }
                        },
                        error : function(obj) {
                            console.log(obj.responseText);
                        },
                        complete:function () {
                            ajaxLock = false;
                        }
                    });
                }

            });


        });
    })(jQuery);

</script>
    <?php else: ?>
    <script>
    (function ($) {
        EditLoad = function() {
            var $in = $("input[name='redirect_uri']");
            $in.val($in.data('url'));

            var $state = $("input[name='state']");
            $state.val($state.data('val')+'/'+$.getHash());

            $('#editPage form').submit();
        }
    })(jQuery)
</script><?php endif; ?>

<!-- detail js -->
<script>
    (function ($) {
        // 当前id
        var current = '';

        // 两种取值之一,content 或 comment 阅读区和评论区
        var module = '';

        // 话题的模板
        var topicTpl = $.getTpl('#showTopicTpl');

        // 评论的模板
        var cmmntTpl = $.getTpl('#commentTpl');

        var loadMoreComments = function () {  };

        var commentsAppendCallback = function ($comment,i,appendObj) {
            // 时间处理
            $comment.find('.comment-time').text($.getDateDiff(appendObj.addtime));

            // 有图片就加上图片
            if (!appendObj.src) {
                $comment.find('.comment-img-wrapper').remove();
            }

            // 公众号高亮显示
            if (parseInt(appendObj.usr_status) > 1) {
                $comment.find('.nick').addClass('public-nick');
            }

            // 只显示自己的工具栏
            if (appendObj.uid == '<?php echo ($uid); ?>') {
                $comment.find('.comment-tools').prepend(
                        '<span class="user-comment-tools">' +
                        '<a class="comment-del">删除</a> |' +
                        '</span>');

                $comment.find('.comment-del').data('id',appendObj.cmid);
            }
            // 显示非自己的工具栏
            else {
                $comment.find('.comment-tools').prepend(
                        '<span class="other-comment-tools">' +
                        '<!--<a>@TA</a> |-->' +
                        '</span>');
            }

            // 如果是管理员
            if (parseInt('<?php echo ($isAdm); ?>')) {
                var status = parseInt(appendObj.status);
                var isRecommended = parseInt(appendObj.recmmd);


                if (status) {
                    $comment.find('.block-comment').show();
                }
                else {
                    $comment.find('.show-comment').show();
                }


                if (isRecommended) {
                    $comment.find('.recommend-cancel').show();
                }
                else {
                    $comment.find('.recommend-comment').show();
                }


            }
        };

        // 加载热门评论
        var loadHotComments = function (type,id) {

            if (arguments.length<2) {
                type    = current.split('/')[0];
                id      = current.split('/')[1];
            }


            $.ajax({
                url     :   "<?php echo U('Detail/loadHotComments');?>",
                dataType:   'json',
                data    :   {   tid : id  },
                success:    function (obj) {
                    if ($.isArray(obj) && obj.length) {
                        $.each(obj,function (i,comment) {
                            $('#hot-comments .comment-wrappers').append($.compile(cmmntTpl,comment));

                            commentsAppendCallback(
                                    $('#hot-comments .comment-wrappers').children(':last'),
                                    i,  comment);
                        });
                        flushHotComments(true);
                    }
                },
                error:      function () {
                    Materialize.toast('<font class="red-text">网络错误,无法加载热门评论</font>', 3000);
                }
            });
        };

        // 刷新热门评论区
        var flushHotComments = function (show) {
            if (show) {
                $('#hot-comments').show();
            }
            else {
                console.log("热门数量"+$('#hot-comments .comment-wrapper').length);
                if ($('#hot-comments .comment-wrapper').length>0) {
                    $('#hot-comments').show();
                }
                else {
                    $('#hot-comments').hide();
                }
            }
        };

        // 强行刷新评论区
        var flushComments = function (type,id) {

            if (arguments.length<2) {
                type    = current.split('/')[0];
                id      = current.split('/')[1];
            }

            // 不显示没有提示
            $('#nomore-comments').hide();
            // 清空评论区
            $('#comments .comment-wrappers').empty();
            // 显示评论区
            $('#comments').show();

            // 每次打开新的文章就重新建立模型
            $('#detailPage').buildLoadMoreModel(new function () {

                this.maxLoadNum = parseInt("<?php echo C('CMMNT_NUM_A_PAGE');?>");

                this.isActive = function () { return true; };

                this.showLoading = function () {
                    $('#comments-loading').show();
                };

                this.hideLoading = function () {
                    $('#comments-loading').hide();
                };

                this.end = function () {
                    $('#nomore-comments').show();
                };

                this.selector = '#comments .comment-wrappers';

                this.template = cmmntTpl;

                this.calls = [
                    function (execute) {
                        loadMoreComments = execute;
                        var exc = execute();
                        if (!exc.result) {
                            console.log(exc.log);
                        }
                    }
                ];


                // 这个也是判断类型
                this.url = "<?php echo U('Detail/loadComments');?>";

                // 应该判断类型type
                this.args = { tid : id };

                // 主键名称
                this.pkName = 'cmid';

                this.appendCallback = commentsAppendCallback;

                this.error = function () {
                    Materialize.toast('<font class="red-text">'+'网络错误,无法加载评论'+'</font>', 3000);
                };

                this.complete = function () {

                }
            });
        };

        DetailLoad = function(data) {
            var hashArr =  $.getHashArr();
            var type = hashArr[1];
            var id = hashArr[2];
            if ( current != type+'/'+id) {
                var url = '';
                var tpl = '';
                switch (type) {
                    case 'topic':
                        url = "<?php echo U('Detail/getTopic');?>";
                        tpl = topicTpl;
                        break;
                }

                // 修改评论按钮的锚点
                $('#edit-comment-btn').attr('href','#edt/comment/'+type+'/'+id);
                // 隐藏评论区
                $('#comments').hide();

                // 显示正在加载中
                $('#content .card-content').html('<div class="center-align">正在加载中...</div>');

                $(document).scrollTop(0);

                $.get(  url,
                        {  id : id },
                        function (obj) {
                            // 编译到模板
                            $('#content .card-content').html($.compile(tpl,obj));
                            // 加载热门评论
                            loadHotComments(type,id);
                            // 刷新评论区
                            flushComments(type,id);
                        },
                        'json');

                current = type+'/'+id;
            }
        };



        $(document).ready(function ($) {

            // 点击刷新评论刷新dom
            $('#flush-comments').click(flushComments);

            var contentHeight = 0;
            function getContentHeight() {
                return contentHeight
                        ? contentHeight
                        : (contentHeight = $('#detailPage #content').height()
                            + parseInt($('#detailPage #content').css('margin-top').match(/[0-9]*/)[0]));
                            //+ parseInt($('#detailPage #content').css('margin-bottom').match(/[0-9]*/)[0]));
            }

            // 锚点定位
            $("#detailPage .tab a[data-location]").click(function () {
                var moduleTarget = $(this).data('location').replace('#','');
                if (moduleTarget != module) {
                    if (moduleTarget == 'content') {
                        $(document).scrollTop(0);
                    }
                    else {
                        // 主体内容的高度
                        $(document).scrollTop(getContentHeight());
                    }
                    module = moduleTarget;
                }
            });

            // 滑动监听
            var _hash = $('#detailPage').data('hash-page');
            $(window).scroll(function () {
                var scrollTop = $(document).scrollTop();
                if ($.getHashRoot() == _hash) {
                    var moduleTarget;

                    if (scrollTop < getContentHeight())
                    { moduleTarget = 'content'; }
                    else
                    { moduleTarget = 'comments'; }


                    if (module != moduleTarget) {
                        //console.log(moduleTarget);
                        module = moduleTarget;
                        $("#detailPage .tab a[data-location='#"+module+"']").click();
                    }


                    // 是否已经滑动到页面底部
                    if ($(document).height() - $(window).height() - scrollTop <= 0) {
                        // 并且执行成功
                        var exec = loadMoreComments();
                        if (exec.result) {
                            console.log('滑动到底部加载...'+exec.log);
                        }
                    }
                }
            });

            /**
             * 删除评论或屏蔽评论
             */
            $('#detailPage').on('click','.comment-del,.recommend-comment,.recommend-cancel,.block-comment,.show-comment',function () {
                var
                        $this = $(this),
                        id = $this.closest('.comment-wrapper').data('commentid'),
                        $comment = $(".comment-wrapper").filter(function () {
                            return $(this).data('commentid') == id;
                        }),
                        url,
                        callback;

                // 删除评论
                if ( $this.is('.comment-del') ) {
                    if (!confirm('真的要删除吗')) return;
                    url = "<?php echo U('Comment/del');?>";
                    callback = function (obj) {
                        $this.parents('.comment-wrapper').remove();
                    }
                }

                // 推荐评论
                else if($this.is('.recommend-comment')) {
                    if (!confirm('请确认是否推荐该评论')) return;
                    url = "<?php echo U('Adm/recommendComment');?>";
                    callback = function (obj) {
                        $comment.find('.recommend-comment').each(function () {
                            $(this).hide();
                        });
                        $comment.find('.recommend-cancel').each(function () {
                            $(this).show();
                        });

                        // 添加到热评
                        $('#hot-comments .comment-wrappers').append($comment.clone().get(0));
                        // 刷新热评区
                        flushHotComments();
                    }
                }
                // 取消推荐评论
                else if($this.is('.recommend-cancel')) {
                    if (!confirm('请确认是否取消推荐该评论')) return;
                    url = "<?php echo U('Adm/recommendCancel');?>";
                    callback = function (obj) {
                        $comment.find('.recommend-comment').each(function () {
                            $(this).show();
                        });
                        $comment.find('.recommend-cancel').each(function () {
                            $(this).hide();
                        });
                        // 删除热评
                        $comment.filter(function () {
                            return $(this).closest('#hot-comments').length;
                        }).remove();
                        // 刷新热评区
                        flushHotComments();
                    }
                }

                // 屏蔽评论
                else if ( $this.is('.block-comment') ) {
                    if (!confirm('真的要屏蔽吗')) return;
                    url = "<?php echo U('Adm/blockComment');?>";
                    callback = function (obj) {
                        $comment.find('.show-comment').show();
                        $comment.find('.block-comment').hide();
                    }
                }
                // 显示评论
                else if ( $this.is('.show-comment') ) {
                    if (!confirm('请确认')) return;
                    url = "<?php echo U('Adm/showComment');?>";
                    callback = function (obj) {
                        $comment.find('.block-comment').show();
                        $comment.find('.show-comment').hide();

                    }
                }

                $.ajax({
                    url :       url,
                    type:       "POST",
                    dataType:   'json',
                    data:   {
                        id : id
                    },
                    success:    function (obj) {
                        if (obj.status) {
                            Materialize.toast('<font class="green-text">'+obj.info+'</font>', 3000);
                            callback(obj);
                        }
                        else {
                            Materialize.toast('<font class="red-text">'+obj.info+'</font>', 3000);
                            console.log(obj)
                        }
                    },
                    error:      function () {
                        Materialize.toast('<font class="red-text">网络错误,操作失败</font>', 3000);
                    }
                });
            });
        });


    })(jQuery);

</script>
<!-- init js -->
<script type="text/javascript">
    (function ($) {
        // 当前hash root (全局变量)
        var lctHash;
        // 之前的hash root (全局变量)
        var preHash;

        lctHash = $.getHashRoot();

        $(document).ready(function () {
            var loadPage = function () {
                var loader = $('[data-hash-page]')
                        .filter(function () { return $(this).attr('data-hash-page') == lctHash; })
                        .show()
                        .data('loader');
                if (window[loader]) {
                    window[loader]();
                }
                console.log('loadPage');
            };

            // 第一次打开页面,对hash进行检查
            if (!lctHash.length) {
                location.href = '#home';
            }
            else {
                loadPage();
                (function () {
                    var _hashArr =  $.getHashArr();
                    var _hash =  $.getHash();
                    switch (lctHash) {
                        case 'home' :
                            break;
                        case 'detail' :
                            // 第一次打开了detail页面,先跳转到主页,然后
                            history.replaceState(null,'','#home');
                            history.pushState(null,'','#'+_hash);
                            break;
                        case 'edt' :
                            switch(_hashArr[1]) {
                                case 'comment':
                                    history.replaceState(null,'','#home');
                                            
                                    setTimeout(function () {
                                        history.pushState(null,'','#detail/'+_hashArr[2]+'/'+_hashArr[3]);

                                        history.pushState(null,'','#'+_hash);
                                    },50);
                                    break;
                            }
                            break;
                    }
                })();
            }




            window.onhashchange = function () {

//                var _url = location.protocol+"//"+location.hostname+location.pathname;
//                console.log(_url);

                // 获取新的hash值
                var _hash = $.getHashRoot();

                if (lctHash != _hash) {
                    // 空的锚点不需要关闭页面
                    if (lctHash.length > 0) {

                        // 关闭页面
                        $('[data-hash-page='+lctHash+']').hide();
                    }

                    // 更新hash
                    lctHash = _hash;

                    console.log('进入页面:'+lctHash);

                }

                loadPage();
                console.log('onhashchange');
            };
        });
    })(jQuery)

</script>
</html>