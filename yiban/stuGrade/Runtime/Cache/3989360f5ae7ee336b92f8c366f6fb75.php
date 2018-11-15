<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>易查成绩</title>
    <!--<link href="https://cdn.bootcss.com/ionic/1.3.2/css/ionic.css" rel="stylesheet">-->
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: "微软雅黑";
    }
    body {
        background-color: #f2f4f3;
    }
    .header {
        background:#ffffff;
        width: 100%;
        height:50px;
        border: 0;
        box-shadow:0 1px 1px rgba(0,0,0,0.2);
        position: relative;
    }
    .header .title {
        position: absolute;
        width: 100%;
        line-height: 50px;
        text-align: center;
        color: #333333;
    }
    .content {
        width: 100%;
    }

    .list {
        overflow-x: hidden;
    }
    .item {
        width: 100%;
        background: #FFFFFF;
        padding: 16px;
        color: #666666;

        overflow: hidden;
        zoom: 1;
    }
    .item+.item {
        border-top: 1px solid #e5e5e5;
    }

    .item span {
        float: left;
    }

    .span1 {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;

        width: 50%;
    }
    .span2 {
        width: 25%;
    }
</style>
<body>
<div class="header">
    <div class="title"><?php echo C('START_YEAR');?>-<?php echo C('END_YEAR');?>第<?php echo C('TERM');?>学期成绩(每天凌晨之后更新)</div>
</div>
<div class="content list">
    <!-- has-footer -->
    <!--标题-->
    <?php if($errMsg != null): ?><!--提示错误-->
        <div class="item">
            <font color="#f08080"><?php echo ($errMsg); ?></font>
        </div>

        <?php else: ?>

        <div class="item" style="color: #999999">
            <span class="span1">科目</span>
            <span class="span2">期末成绩</span>
            <span class="span2">总评成绩</span>
        </div>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
                <span class="span1"><?php echo ($vo["subjectName"]); ?></span>
                <span class="span2">
                <?php if($vo['grade1'] < 60): ?><font color="#f08080"><?php echo ($vo["grade1"]); ?></font>
                    <?php else: ?>
                    <font color="#20b2aa"><?php echo ($vo["grade1"]); ?></font><?php endif; ?>
                </span>
                <span class="span2">
                <?php if($vo['grade2'] < 60): ?><font color="#f08080"><?php echo ($vo["grade2"]); ?></font>
                    <?php else: ?>
                    <font color="#20b2aa"><?php echo ($vo["grade2"]); ?></font><?php endif; ?>
                </span>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="item" style="color: lightsalmon;">
            <!--<span style="width: 100%;">-->
                请以教务系统成绩为准
            <!--</span>-->
        </div><?php endif; ?>
	<div style="padding:10px;text-align:center;color:#999999;font-size:15px;">
		广东药科大学·易班学生工作站<br>
		提供技术支持
	</div>
</div>
<div style="display: none">
    test: <?php echo ($this_yb_userid); ?>-<?php echo strlen($this_yb_userid);?><br/>
    test: <?php echo ($this_stu_id); ?>-<?php echo empty($this_stu_id);?><br/>
    <?php dump($getAT); ?>
</div>
</body>
</html>