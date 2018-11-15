<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>广药排行榜 | 谁是手速王?</title>
    <link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">
    <link rel="stylesheet" href="__PUBLIC__/css/common.materialize.css">
</head>
<style>
    .ui-loader-default{ display:none}
    .ui-mobile-viewport{ border:none;}
    .ui-page {padding: 0; margin: 0; outline: 0}

    .card .card-content p{
        line-height: 1.6;
        font-size: 14px;
        color: #666666;
    }

    .card .card-content .btn{
        margin-top: 10px;
    }
</style>
<body>
    <div class="container">

        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">广药排行榜(top<?php echo ($rankNum); ?>)</span>

                        <table class="striped">
                            <thead>
                            <tr>
                                <th>排名</th>
                                <th></th>
                                <th>易班昵称</th>
                                <th>最高成绩</th>
                                <th>时间</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td>
                                        <?php echo ($vo["rank"]); ?>
                                    </td>
                                    <td>
                                        <img src="<?php echo ($vo["yb_userhead"]); ?>" class="circle" style="width: 40px;"/>
                                    </td>
                                    <td><?php echo ($vo["nick"]); ?></td>
                                    <td><?php echo ($vo["score"]); ?></td>
                                    <td><?php echo ($vo["time"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <p class="grey-text">*注意事项</p>
                        <p class="grey-text">1. 按照最高成绩排名</p>
                        <p class="grey-text">2. 获得相同最高成绩的所有人,按照获得成绩的时间计算,时间越早,排名越前</p>
                        <a href="<?php echo U('game');?>" class="light-green waves-effect waves-light btn" style="width: 100%">点击这里，开始游戏</a>
                        <?php if($yb_userid): ?><a href="<?php echo U('gameInfo');?>?id=<?php echo ($yb_userid); ?>" class="light-green waves-effect waves-light btn" style="width: 100%">查看我的记录</a><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>