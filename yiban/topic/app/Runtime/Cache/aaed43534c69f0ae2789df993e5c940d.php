<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>奖品兑换</title>
    
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

<body>
<form>
    <div class="edit-area main-bg-color">
        <div class="input-field">
            <input id="topic-title-editor" type="text" data-length="10" name="code"/>
            <label for="topic-title-editor">在这里输入兑换码</label>
        </div>
    </div>
</form>
<div id="info" style="text-align: center;margin-top: 10px;">
    <?php if($ticket != null): ?><div style="font-size: 20px;"><?php echo ($ticket["content"]); ?></div>
    <?php else: ?>
        <a class="waves-effect waves-light btn">点击这里马上兑换!</a><?php endif; ?>
</div>
<ul style="margin-top: 10px;color: #999999;padding: 10px;">
    领取奖品方法:
    <li>请关注微信公众号 GDPU易班,我们会在9月6日前发布奖品领取通知(详情见微信推文)</li>
</ul>
<script>
    $(document).ready(function ($) {
        var ajaxLock = false;
        $('.btn').click(function () {
            Materialize.toast('正在拼命为您传输信息,请稍等...', 2000);
            if (!ajaxLock) {
                ajaxLock = true;
                $.ajax({
                    url : "<?php echo U('ExTicket/index');?>",
                    type : 'POST',
                    data : $('form').serialize(),
                    dataType:'json',
                    success : function(obj) {
                        console.log(obj);
                        // 提示失败原因
                        if (obj.status == 0 || obj.status == false) {
                            Materialize.toast('<font class="red-text">'+obj.info+'</font>', 2000);
                        }
                        // 提交成功
                        else {
                            $('#info').empty().append('<div style="font-size: 20px;">'+obj.info+'</div>');
                            Materialize.toast('<div style="font-size: 20px;">'+obj.info+'</div>', 4000);
                        }
                    },
                    error : function(obj) {
                        Materialize.toast('<font class="red-text">emmmm...网络状态不是很好,检查一下您的网络?</font>', 2000);
                    },
                    complete:function () {
                        ajaxLock = false;
                    }
                });
            }
        });
    });
</script>
</body>
</html>