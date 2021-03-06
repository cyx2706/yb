<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <?php if($isLogin && $exNum) { ?>

    <title>网薪兑换实物 | 网薪兑换早餐券</title>

    <?php } else { ?>

    <title>网薪兑换 | 网薪兑换早餐券</title>

    <?php } ?>

    <!--<link rel="shortcut icon" href="../favicon.ico" />-->

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
        background-color: #81c784 ;
        height: 100%;
        width: 3px;
        left:0;
        top:0;
    }
</style>
<body>
<!--nav-->
<div class="green darken-2 white-text center-align none-box-shadow truncate" style="padding:0 10px;height: 50px;line-height: 50px;">
    今早绿点早餐券(大学城一饭)
</div>

<div class="container">

    <?php if ($isLogin && $err) { ?>
    <?php  ?>
    <div class="sec-title">错误提示</div>
    <div class="card none-box-shadow">
        <div class="card-content center-align" style="padding: 10px;">
            <b class="red-text">兑换失败...<?php echo ($err); ?></b>
        </div>
    </div>

    <?php } ?>


    <?php if($isLogin && ($exNum1 || $exNum2)) { ?>

    <div class="sec-title">兑换结果</div>
    <div class="card none-box-shadow">
        <div class="card-content center-align" style="padding: 10px;">
            <!--兑换成功集赞-->
            <p>您已成功兑换 <b class="green-text"><?php echo ($exNum1); ?>张3元餐券</b> ！</p>
            <p>您已成功兑换 <b class="green-text"><?php echo ($exNum2); ?>张5元餐券</b> ！</p>
            <p>领取体验券前请将该页面转发到朋友圈并集<b class="green-text text-darken-2">10个赞</b></p>
        </div>
    </div>

    <?php } ?>


    <div class="sec-title">活动介绍</div>
    <div class="card none-box-shadow">
        <div class="card-content" style="padding: 10px;">
            <p><b>3元餐券</b>每人每7天可兑换<b>2次</b></p>
            <p><b>5元餐券</b>每人每7天可兑换<b>1次</b></p>
            <p style="color: #999999">数量有限先抢先得</p>
        </div>
    </div>

    <div class="sec-title">获取步骤</div>
    <div class="card none-box-shadow">
        <div class="card-content" style="padding: 10px;">
            <p>点击下面兑换按钮，即可用网薪进行线上兑换，<a href="http://mp.weixin.qq.com/s/Eoujg2weEqAPwJbnqN1d5A">点击这里查看如何获得网薪?</a></p>
            <p><b class="green-text text-darken-2">兑换成功</b>后，将兑换结果页面转发到朋友圈并<b class="green-text text-darken-2">集10个赞</b></p>
            <p>在值班时间到易班学生工作站值班室凭<b class="green-text text-darken-2">兑换码</b>及<b class="green-text text-darken-2">朋友圈集赞结果</b>领取体验券即可，<a href="http://mp.weixin.qq.com/s/y3cPkfxJzfyanNEKI2vaCw">点击这里查看易班工作室在哪？</a></p>
        </div>
    </div>

    <div class="sec-title">使用方法</div>
    <div class="card none-box-shadow">
        <div class="card-content" style="padding: 10px;">
            <p>活动开展时间截止至1月10日前,餐券的兑换及使用仅在活动举办期间有效</p>
            <p>兑换地点仅限<b>大学城一饭今早绿点</b></p>
        </div>
    </div>

    <?php  if($isLogin) { ?>

    <div class="row center-align">
        <a href="<?php echo U('exchange2',array('id'=>C('SPCL_GIFT_ID.BREAKFAST1')));?>" class="waves-effect green darken-2 white-text btn" style="width: 100%">点击这里兑换一张3元餐券(400网薪)</a>
    </div>

    <div class="row center-align">
        <a href="<?php echo U('exchange2',array('id'=>C('SPCL_GIFT_ID.BREAKFAST2')));?>" class="waves-effect green darken-2 white-text btn" style="width: 100%">点击这里兑换一张5元餐券(700网薪)</a>
    </div>
    <?php } else { ?>

    <a href="<?php echo U('Index/index');?>" class="waves-effect green darken-2 white-text btn" style="width: 100%">请先登录</a>

    <?php } ?>
</div>
<div class="row center-align">
    <!--<span class="green-text text-darken-2">广东药科大学易班学生工作站</span><br>-->
    <!--提供技术支持-->
</div>
</body>
</html>