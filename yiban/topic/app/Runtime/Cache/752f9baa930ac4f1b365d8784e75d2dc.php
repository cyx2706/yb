<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登录</title>
    
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
    * {
        padding: 0;
        margin: 0;
    }
    html,body {
        height: 100%;
    }
    body>div {

        height: 100px;
        line-height: 100px;
        width: 100%;
        position: absolute;
        top:0;
        left: 0;
        font-size: 30px;
        color: #ffffff;
        text-align: center;
    }
    form {
        height: 250px;
        width: 100%;
        display: block;

        position: absolute;
        z-index: 100;
        top:100px;
        left:0;
        padding: 20px;
        /*transform: translate(-50%,-50%);*/
        /*background-color: #ffffff;*/
    }
</style>
<body>
<div class="main-bg-color">
    管理员登录
</div>
<form action="" method="post">
    {__TOKEN__}
    <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <input id="icon_prefix" type="text" class="validate">
        <label for="icon_prefix">账号</label>
    </div>

    <div class="input-field">
        <i class="material-icons prefix">lock_outline</i>
        <input id="password" type="password" class="validate">
        <label for="password">密码</label>
    </div>

    <div style="width: 100%;height: 63px;overflow: hidden;zoom: 1">
        <div class="input-field" style="width: 59%;margin-right: 1%;float: left">
            <i class="material-icons prefix">android</i>
            <input id="verify" type="text" class="validate">
            <label for="verify">验证码</label>
        </div>
        <div style="width: 40%;height: 100%;float: left;position: relative;background-color: red">
            <div style="width: 100%;height: 100%;position: absolute;background-color: red">
                <img src="http://img02.fs.yiban.cn/12135664/avatar/user/200" style="width: 100%;height: 100%">
            </div>
        </div>
    </div>

    <div class="fixed-action-btn">
        <button class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">done</i></button>
    </div>
</form>
</body>
</html>