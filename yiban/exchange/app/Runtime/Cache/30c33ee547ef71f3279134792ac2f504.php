<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <?php if($isLogin && $exNum) { ?>

    <title>网薪兑换实物 | 我用10个易班网薪抢到了免费健身体验，不说了我先去瘦了</title>

    <?php } else { ?>

    <title>网薪兑换 | LUCKY PANDA 一周健身体验券</title>

    <?php } ?>

    <link rel="shortcut icon" href="../favicon.ico" />

    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">
    <link rel="stylesheet" href="__PUBLIC__/css/common.materialize.css">

    <!-- jQuery -->
    <script src="__PUBLIC__/js/jquery-2.2.0.js"></script>

    <script src="__PUBLIC__/js/materialize.min.js"></script>

</head>
<style>
    .sec-title {
        position: relative;
        font-weight: bold;
        line-height: 1.6;
        margin: 10px 0;
        padding-left: 8px;
    }
    .sec-title:before {
        content: " ";
        position: absolute;
        background-color: pink;
        height: 100%;
        width: 3px;
        left:0;
        top:0;
    }
</style>
<body>
<!--nav-->
<div class="pink white-text center-align none-box-shadow truncate" style="padding:0 10px;height: 50px;line-height: 50px;">
    LUCKY PANDA 一周免费健身体验券
</div>

<div class="container">

    <?php if ($isLogin && $err) { ?>

    <div class="sec-title">错误提示</div>
    <div class="card none-box-shadow">
        <div class="card-content center-align" style="padding: 10px;">
            <b class="red-text">兑换失败...<?php echo ($err); ?></b>
        </div>
    </div>

    <?php } ?>


    <?php if($isLogin && $exNum) { ?>

    <div class="sec-title">兑换结果</div>
    <div class="card none-box-shadow">
        <div class="card-content center-align" style="padding: 10px;">
            您已成功兑换 <b class="green-text"><?php echo ($exNum); ?>张体验券</b> ！领取体验券前请将该页面转发到朋友圈并集<b class="pink-text"><?php echo ($exNum); ?>0个赞</b>
        </div>
    </div>

    <?php } ?>


    <div class="sec-title">活动介绍</div>
    <div class="card none-box-shadow">
        <div class="card-content" style="padding: 10px;">
            <p>每人最多可抢3张</p>
            <p style="color: #999999">数量有限先抢先得</p>
        </div>
    </div>

    <div class="sec-title">健身房介绍</div>
    <div class="card none-box-shadow">
        <div class="card-content" style="padding: 10px;">
            <p>体能提升、减脂、塑形</p>
            <p>独创12—3ROUND女子健身课程</p>
            <p>个人定制课程，免费教练指导</p>
            查看更加详细介绍，<a href="http://mp.weixin.qq.com/s/UIknMUCBadxOx1HQVbWaWA">戳这里</a>！
        </div>
    </div>

    <div class="sec-title">获取步骤</div>
    <div class="card none-box-shadow">
        <div class="card-content" style="padding: 10px;">
            <p>点击"10网薪兑换" ，<a href="https://mp.weixin.qq.com/s/ALy22RF_rf4gL5shLvf7TA">点击这里查看如何获得网薪?</a></p>
            <p><b class="pink-text">兑换成功</b>后，将兑换结果页面转发到朋友圈并<b class="pink-text">集赞</b>,集赞的数量是抢到的<b class="pink-text">张数*10个</b></p>
            <p>在值班时间到易班学生工作站值班室凭<b class="pink-text">兑换码</b>及<b class="pink-text">朋友圈集赞结果</b>领取体验券即可，<a href="https://mp.weixin.qq.com/s/ALy22RF_rf4gL5shLvf7TA">点击这里查看易班工作室在哪？</a></p>
            <!--<p class="grey-text">先到先得,送完即止</p>-->
        </div>
    </div>

    <div class="sec-title">使用步骤</div>
    <div class="card none-box-shadow">
        <div class="card-content" style="padding: 10px;">
            <p>使用前请先进行电话预约，详情见卡片背面</p>
        </div>
    </div>

    <?php if($isLogin) { if ($isSuccess) { ?>

    <!--兑换成功-->
    <!--<div class="row center-align">
        <b class="red-text">兑换成功! 请将该页面转发到朋友圈并集齐10个赞</b>
    </div>-->

    <a href="<?php echo U('exchange');?>" class="waves-effect pink white-text btn" style="width: 100%">10网薪兑换</a>
    <?php } else { ?>

    <!--兑换失败或者没有兑换-->
    <a href="<?php echo U('exchange');?>" class="waves-effect pink white-text btn" style="width: 100%">10网薪兑换</a>

    <?php } } else { ?>

    <a href="<?php echo U('Index/index');?>" class="waves-effect pink white-text btn" style="width: 100%">10网薪兑换</a>

    <?php } ?>
</div>
<div class="row center-align">
    <!--<span class="pink-text">广东药科大学易班学生工作站</span><br>-->
    <!--提供技术支持-->
</div>
</body>
</html>