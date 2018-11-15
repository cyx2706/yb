<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网薪兑换 | 管理员登录</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">

    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->

    <!-- jQuery -->
    <!--<script src="__PUBLIC__/js/jquery-2.2.0.js"></script>-->

    <!-- Compiled and minified JavaScript -->
    <!--<script src="__PUBLIC__/js/materialize.min.js"></script>-->
</head>
<style>
    body{
        background-color: #f8f8f8;
    }
</style>
<body>
    <div class="white card-panel" style="max-width: 300px;margin: 30px auto;">
        <form action="" method="post">
            账号 <input name="username"/><br/>
            密码 <input name="password"/><br/>
            验证码 <input name="verify"/><br/>
            <img style="width: 100px;" src="<?php echo U('verify');?>">

            <button type="submit" class="waves-effect btn" style="width: 100%">登录</button>
        </form>
    </div>
</body>
</html>