<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理</title>
    
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
    <script type="text/javascript" src="__PUBLIC__/ckeditor_full/ckeditor.js"></script>
</head>
<style>
    .tab-wrapper {
        padding-left: 10px;padding-right: 10px;
    }
</style>
<body>
<nav class="nav-extended none-box-shadow">
    <!--tabs-->
    <div class="nav-content">
        <ul class="tabs tabs-transparent overflow-hidden">
            <!--class="active" -->
            <li class="tab"><a href="#send">发布</a></li>
            <li class="tab"><a href="#manage">管理</a></li>
            <li class="tab"><a href="#upd">修改</a></li>
        </ul>
    </div>
</nav>
<div id="tab-wrappers">

    <div id="send" class="tab-wrapper">
        <div class="card none-box-shadow">
            <div class="card-content">
                <span class="card-title">发布话题</span>
                <!--<p class="truncate"></p>-->
                <div class="input-field">
                    <input id="send-title" type="text" class="validate">
                    <label for="send-title">在这里输入标题</label>
                </div>

                <div>
                    <textarea id="send-hidden" style="display: none"></textarea>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <a class="waves-effect waves-light btn sub" style="width: 100%">提交</a>
        </div>
    </div>

    <!-- 修改 -->
    <div style="opacity: 0" id="upd" class="tab-wrapper">
        <div class="card none-box-shadow">
            <div class="card-content">
                <span class="card-title">修改话题</span>

                <!--id-->
                <input id="upd-tid" type="hidden"/>

                <!---->
                <div class="input-field">
                    <input id="upd-title" type="text" class="validate">
                    <label for="upd-title">要修改的标题</label>
                </div>

                <div>
                    <textarea id="upd-hidden" style="display: none"></textarea>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <a class="waves-effect waves-light btn sub" style="width: 100%">提交</a>
        </div>
    </div>
    
    <div id="manage" class="tab-wrapper">
        <!--模板-->
        <script type="text/html" id="tpl">
            <div style="display: none" class="card none-box-shadow tpc" data-tid="<?php echo ($tpc["tid"]); ?>">
                <div class="card-content">
                    <span class="card-title"><?php echo ($tpc["title"]); ?></span>
                    <div class="truncate"><?php echo ($tpc["content"]); ?></div>
                </div>
            </div>
        </script>

        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tpc): $mod = ($i % 2 );++$i;?><div class="card none-box-shadow tpc" data-tid="<?php echo ($tpc["tid"]); ?>">
                <div class="card-content">
                    <span class="card-title"><?php echo ($tpc["title"]); ?></span>
                    <div class="truncate"><?php echo ($tpc["content"]); ?></div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

<script>
    var editorConfig = {
        language:'zh-cn',//简体中文
        //width : editorWidth, //宽度
        //height:340, //高度
        toolbar ://工具栏设置
                [
                    [/*'Source',*/'Maximize','-','Save','NewPage','Preview','-','Templates'],
                    ['Cut','Copy','Paste','PasteText','PasteFromWord'],
                    ['Undo','Redo','-','Find','Replace','-','Table','HorizontalRule','-','SelectAll','RemoveFormat'],
                    /*'/',//工具栏换行符*/
                    ['Bold','Italic','Underline','Strike'/*,'-','Subscript','Superscript'*/],
                    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                    ['Link','Unlink','Anchor'],
                    /*'/',//工具栏换行符*/
                    ['Image',/*'Flash',*/'Smiley','SpecialChar','PageBreak'],
                    ['Styles','Format','Font','FontSize'],
                    ['TextColor','BGColor']
                ]
        ,
        //图片上传相关
        filebrowserImageUploadUrl : "<?php echo U('Common/ckUploadImg');?>",
        image_previewText : ' '
    };
    var editors = {
        send: CKEDITOR.replace('send-hidden', editorConfig),
        upd: CKEDITOR.replace('upd-hidden', editorConfig),
    };

    jQuery(document).ready(function ($) {
        $('.sub').click(function () {
            var id = $(this).closest('.tab-wrapper').attr('id');
            var $this = $(this);
            if (!$this.is('.disabled')) {
                $this.addClass('disabled');
                $this.text('正在提交中...');
                var url = "";
                var data = {
                    'title' : $('#'+id+'-title').val(),
                    'content': editors[id].getData()
                };

                // 获取对应话题的dom的函数
                var getElem;

                switch (id) {
                    case 'send':
                        url         = "<?php echo U('Topic/add');?>";
                        getElem    = function (data) {
                            // 滑动到页面顶部
                            $(document).scrollTop(0);
                            $('#manage').prepend($('#tpl').html());
                            return $('#manage').children(':first').show();
                        };
                        break;
                    case 'upd':
                        url         = "<?php echo U('Topic/upd');?>";
                        data['tid'] = $('#upd-tid').val();
                        getElem    = function (data) {
                            $(document).scrollTop(0);
                            return $("[data-tid='"+data.tid+"']");
                        };
                        break;
                    default:
                        ;
                }
                console.log(data);

                $.ajax({
                    url     : url,
                    type    : "post",
                    dataType: 'json',
                    data    : data,
                    success : function (obj) {
                        if (obj.status) {
                            $("[href='#manage']").trigger('click');
                            Materialize.toast('<font class="green-text">'+obj.info+'</font>', 4000);
                            var $elem = getElem(obj.data);
                            $elem.data('tid',obj.data.tid);
                            $elem.find('.card-title').text(obj.data.title);
                            $elem.find('.truncate').html(obj.data.content);
                        }
                        else {
                            Materialize.toast('<font class="red-text">'+obj.info+'</font>', 4000);
                        }
                        console.log(obj);

                    },
                    error   : function (obj) {
                        Materialize.toast('<font class="red-text">emmmm...网络状态不是很好,检查一下您的网络?</font>', 4000);
                    },
                    complete: function () {
                        $this.removeClass('disabled');
                        $this.text('提交');
                    }
                });
            }
        });

        // 移动端 document on click 无效
        $('#manage').on('click','.tpc',function () {
            // 跳转到更新模块
            $("[href='#upd']").click();

            // 记录id
            $('#upd-tid').val($(this).data('tid'));

            // 记录title
            $('#upd-title').val($(this).find('.card-title').text());
            Materialize.updateTextFields();

            editors['upd'].setData($(this).find('.truncate').html());

            $('#upd').css('opacity','1');
        })
    });
</script>
</body>
</html>