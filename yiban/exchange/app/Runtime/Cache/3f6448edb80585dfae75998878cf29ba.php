<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网薪兑换</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

    <link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">
    <link rel="stylesheet" href="__PUBLIC__/css/common.materialize.css">

    <!-- jQuery -->
    <script src="__PUBLIC__/js/jquery-2.2.0.js"></script>

    <script src="__PUBLIC__/js/materialize.min.js"></script>
</head>
<style>
    body {
        background-color: #f8f8f8;
    }
    /*
    .tabs.tabs-transparent .indicator {
        background-color: #ffeb3b;
    }*/
    .modal-content-block+.modal-content-block {
        border-top: 1px solid #eeeeee;
    }
    .modal-content-block {
        padding: 20px 10px 0 10px;
    }
    .modal-content-block .s7{
        line-height: 30px;
    }
    .modal.bottom-sheet {
        max-height: 100%;
    }
    .btn-square {
        border: none;
        text-align: center;
        border-radius: 2px;
        width: 30px;height: 30px;line-height: 30px;font-size: 20px;font-weight: bold;
    }
    #modal_img img {
        /*position: absolute;
        top: 0;
        left: 0;*/
        height: 100%;
        width: 100%;
    }
    img {
        max-width: 150px;
    }
    .row .card {
        margin-bottom: 0;
    }
    .card-content>.row {
        margin-bottom: 0;
    }
</style>
<script>
    //字符串转换为时间戳
    function getDateTimeStamp (dateStr) {
        return Date.parse(dateStr.replace(/-/gi,"/"));
    }

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

        if(d_days > 0 && d_days < 3){
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
            return M + '-' + D + '&nbsp;' + H + ':' + m;
        }else if (d_days >= 30) {
            return Y + '-' + M + '-' + D + '&nbsp;' + H + ':' + m;
        }
    }
</script>
<body>
<nav class="nav-extended cyan lighten-4 none-box-shadow">
    <!--tabs-->
    <div class="nav-content">
        <ul class="tabs tabs-transparent overflow-hidden">
            <!--class="active" -->
            <li class="tab"><a href="#list" class="black-text">兑换列表</a></li>
            <li class="tab"><a href="#home" class="black-text">我的<!--<span class="new badge yellow black-text"></span>--></a></li>
        </ul>
    </div>
</nav>
<?php if ($errMsg) { ?>

<div class="card none-box-shadow modal-trigger" data-target="modal1" data-id="<?php echo ($vo['exgid']); ?>">
    <div class="card-content" style="padding: 10px;">
        <p class="red-text center-align"><?php echo ($errMsg); ?></p>
    </div>
</div>

<?php } else { ?>

<div id="list" class="tab-wrapper">
    <div class="container">

        <?php  $spclCounter = 0; $allNum = count($list); for ($i=0; $i<$allNum; $i++) { if (! (int)$list[$i]['special']) { break; } $spclCounter++; $vo = $list[$i]; ?>
        <div class="row">
            <div class="col s12 m12">
                <!--href="<?php echo U($vo['href']);?>" -->
                <a href="<?php echo U($vo['href']);?>" class="card horizontal none-box-shadow">
                    <div class="card-image">
                        <img style="max-width: 150px;" src="<?php echo ($vo['img']); ?>">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <div class="" style="color:#333333;"><?php echo ($vo['name']); ?></div>
                            <div style="color:#999999;"><?php echo ($vo['detail']); ?></div>
                        </div>
                    </div>

                </a>

            </div>
        </div>

        <?php } $listNum = $allNum - $spclCounter; $colNum = 2; $width = 12/$colNum; $rowNum = ceil($listNum/$colNum); for ($i = 0; $i<$rowNum; $i++) { ?>
        <div class="row">
            <?php for ($j=0; $j<$colNum; $j++) { $vo = $list[$spclCounter+$i*$colNum+$j]; if (!$vo) continue; ?>



            <div class="col s<?php echo ($width); ?> m<?php echo ($width); ?>">
                <div class="card none-box-shadow modal-trigger" data-target="modal1" data-id="<?php echo ($vo['exgid']); ?>">
                    <div class="card-image">
                        <img style="margin: 0 auto" src="<?php echo ($vo['img']); ?>">
                        <!--<span class="card-title">Card Title</span>-->
                    </div>
                    <div class="card-content" style="padding: 10px;">
                        <p class="truncate">
                            <span class="name"><?php echo ($vo['name']); ?></span>
                            <span class="right ">
                            <b class="yellow-text text-darken-1">
                                <span class="pay"><?php echo ($vo['pay']); ?></span>
                                网薪</b>
                            </span>
                        </p>

                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
        <?php } ?>

    </div>
</div>

<?php  ?>
<div id="home">
    <div class="container">

        <!-- 领取提示 -->
        <div class="card none-box-shadow">
            <div class="card-content" style="padding: 10px;">
                兑换之后应该如何领取?  <a href="https://mp.weixin.qq.com/s/tGcJf0p2iS5wyGoQ69wTwg">戳这里!</a>
            </div>
        </div>

        <script type="text/html" id="recTpl">
                    <div class="card none-box-shadow">
                        <!--<div class="card-image">-->
                        <!--<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1506166330423&di=8a3ee760be0a09b79bdf696ba6dd1461&imgtype=0&src=http%3A%2F%2Fd10.yihaodianimg.com%2FN07%2FM07%2F6B%2F72%2FCgQIz1U3RtCAezxQAAA7-bwMH-081400_640x640.jpg">-->
                        <!--</div>-->
                        <div class="card-content" style="padding: 10px;">
                            <div class="row">
                                <div class="col s4">
                                    <img style="width: 100%;height: 100%" src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1506166330423&di=8a3ee760be0a09b79bdf696ba6dd1461&imgtype=0&src=http%3A%2F%2Fd10.yihaodianimg.com%2FN07%2FM07%2F6B%2F72%2FCgQIz1U3RtCAezxQAAA7-bwMH-081400_640x640.jpg"/>
                                </div>
                                <div class="col s8">
                                    <p class="row">
                                        <span class="col s6 rec_name truncate"></span>
                                        <span class="col s6 rec_num"></span>
                                    </p>
                                    <p class="row">
                                        <span class="col s6">兑换码</span>
                                        <span class="col s6 blue-text rec_code"></span>
                                    </p>
                                    <p class="row rec_del_status_0">
                                        <span class="col s6 green-text">已领取</span>
                                    </p>
                                    <p class="row rec_del_status_0">
                                        <span class="col s6">领取时间</span>
                                        <span class="col s16 rec_finish"></span>
                                    </p>

                                    <p class="row rec_del_status_1">
                                        <span class="col s6 red-text">未领取</span>
                                    </p>
                                    <p class="row rec_del_status_1">
                                        <span class="col s6">兑换时间</span>
                                        <span class="col s16 rec_time"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

        </script>
        <?php if(is_array($records)): $i = 0; $__LIST__ = $records;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$record): $mod = ($i % 2 );++$i;?><div class="card none-box-shadow">
                <div class="card-content" style="padding: 10px;">
                    <div class="row">
                        <div class="col s4">
                            <img style="width: 100%;height: 100%" src="<?php echo ($record["img"]); ?>"/>
                        </div>
                        <div class="col s8">
                            <p class="row">
                                <span class="col s6 rec_name truncate"><?php echo ($record["name"]); ?></span>
                                <span class="col s6 rec_num">x<?php echo ($record["num"]); ?></span>
                            </p>
                            <p class="row">
                                <span class="col s6">兑换码</span>
                                <span class="col s6 blue-text rec_code"><?php echo ($record["code"]); ?></span>
                            </p>

                            <?php if($record['status'] == 1): ?><p class="row rec_del_status_0">
                                    <span class="col s6 green-text">已领取</span>
                                </p>
                                <p class="row rec_del_status_0">
                                    <span class="col s6">领取时间</span>
                                    <span class="col s16 rec_finish"><script>document.write(getDateDiff('<?php echo ($record["finish"]); ?>'))</script></span>
                                </p><?php endif; ?>

                            <?php if($record['status'] == 0): ?><p class="row rec_del_status_1">
                                    <span class="col s6 red-text">未领取</span>
                                </p>
                                <p class="row rec_del_status_1">
                                    <span class="col s6">兑换时间</span>
                                    <span class="col s16 rec_time"><script>document.write(getDateDiff('<?php echo ($record["time"]); ?>'))</script></span>
                                </p><?php endif; ?>

                        </div>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>


        <!-- 错误提示 -->
        <div class="card none-box-shadow">
            <div class="card-content" style="padding: 10px;">
                有bug? 想反馈?  <a href="<?php echo U('Feedback/gather');?>">戳这里!</a>
            </div>
        </div>
    </div>



</div>

<div id="modal1" class="modal bottom-sheet white">
    <div class="modal-content" style="padding: 0">

        <div class="modal-action modal-close red white-text lighten-2 btn-square waves-effect" style="position: absolute;right: 0;top: 0;border-radius: 0;border-bottom-left-radius: 2px;">×</div>

        <div class="row modal-content-block center-align" style="position: relative;">
            <div id="modal_img" style="width: 80px;height: 80px;margin: 0 auto"></div>
            <div id="modal_name">
                文具2
            </div>
        </div>

        <!--<h5>请选择兑换的数目</h5>-->
        <div class="row modal-content-block">
            <div class="col s7">
                数量
            </div>
            <div class="col s5">
                <div class="right" style="position: relative;">
                    <form>
                        <input type="hidden" name="id"/>
                        <div data-operand="-1" class="grey lighten-2 btn-square waves-effect" style="float: left;">-</div>
                        <input id="modal_num" name="num" style="border: none;text-align: center;float: left;width: 30px;height: 30px;margin: 0">
                        <div data-operand="1" class="grey lighten-2 btn-square waves-effect" style="float: left;">+</div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row modal-content-block">
            <div class="col s7">
                所需网薪值
            </div>
            <div class="col s5 right-align" id="modal_pay">
                <span class="yellow-text" style="font-weight: bold">0</span>
            </div>
        </div>
    </div>

    <a id="modal_sub" class="waves-effect yellow black-text btn" style="width: 100%">兑换</a>
</div>

<script>
    jQuery(document).ready(function ($) {
        // 模态
        $('.modal').modal();

        // 数量监听并作出反应
        var $modal_num_val = function (num,setVal) {
            if (num <= 0) {
                $modal_num_val(1);
                return;
            }

            var $modal = $('#modal1');
            var pay = $modal.data('pay');
            num = parseInt(num);
            $modal.find('#modal_pay').find('span').text(num*pay);
            $modal.find('#modal_pay').find('input').val(num*pay);
            if (setVal !== false)
                $modal.find('#modal_num').val(num);
        };

        // 点击兑换物品触发事件
        $('[data-target=modal1]').click(function () {
            $('#modal1').modal('open');
            // 保存id
            $('#modal1').data('id',parseInt($(this).data('id')));
            $('#modal1').find('[name=id]').val(parseInt($(this).data('id')));
            // 保存网薪值
            $('#modal1').data('pay',parseInt($(this).find('.pay').text()));
            // 修改模态中显示图片
            $('#modal_img').empty().append('<img src="'+$(this).find('img').attr('src')+'"/>');
            // 修改模态中的名称
            $('#modal_name').text($(this).find('.name').text());

            // 免除点击消失
            $('.modal-overlay').unbind('click');
            // 每次点开默认为1
            $modal_num_val(1);
        });

        // 监听数量输入框
        $('#modal_num').change(function () {
            $modal_num_val($(this).val(),false);
        });

        // 加减数量
        $('[data-operand]').click(function () {
            var num = parseInt($('#modal_num').val());
            var operand = parseInt($(this).data('operand'));
            $modal_num_val(num+operand);
        });

        // 提交表单
        var ajaxLock = false;
        $('#modal_sub').click(function () {
            Materialize.toast('正在处理中,请稍候...', 2000);
            if (!ajaxLock) {
                ajaxLock = true;
                $.ajax({
                    url     : "<?php echo U('pay');?>",
                    data    : $('#modal1').find('form').serialize(),
                    type    : 'get',
                    dataType: 'json',
                    success : function (obj) {
                        if (obj.status) {
                            // 兑换成功提示
                            Materialize.toast('<font class="green-text">'+obj.info+'</font>', 4000);
                            $('#modal1').find('.modal-close').click();
                            $('nav').find("[href='#home']").click();
                            var $new = $('#home .container').prepend($('#recTpl').text()).children(':first');

                            console.log(obj.data);
                            var rec = obj.data;

                            $new.find('.rec_name').text(rec.name);
                            $new.find('img').attr('src',rec.img);
                            $new.find('.rec_num').text('x'+rec.num);
                            $new.find('.rec_code').text(rec.code);
                            $new.find('.rec_time').text(getDateDiff(rec.time));
                            $new.find('.rec_del_status_'+0).remove();
                        }
                        else {
                            // 兑换失败提示
                            Materialize.toast('<font class="red-text">'+obj.info+'</font>', 4000);
                        }
                    },
                    error   : function () {
                        // 网络错误
                        Materialize.toast('<font class="red-text">网络错误,请重新尝试</font>', 4000);
                    },
                    complete: function () {
//                        console.log('已完成');
                        ajaxLock = false;
                    }
                });
            }
        });

    });
</script>

<?php } ?>

</body>
</html>