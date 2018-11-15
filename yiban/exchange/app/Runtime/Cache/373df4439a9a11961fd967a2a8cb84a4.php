<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网薪兑换 | 管理</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- jQuery -->
    <script src="__PUBLIC__/js/jquery-2.2.0.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="__PUBLIC__/js/materialize.min.js"></script>
</head>
<style>
    body {
        background-color: #f8f8f8;
    }
    a {
        cursor: pointer;
    }
    .card-panel {
        margin: 0 auto;
        max-width: 700px;
    }
</style>
<body>

<nav class=" cyan darken-2">
    <div class="nav-wrapper">
        <a class="brand-logo">预约订单管理</a>
        <a href="" class="right button-collapse">更多</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="">更多</a></li>
        </ul>
    </div>
</nav>

<!-- 输入兑换码 -->
<div style="margin: 10px;">
    <div class="white card-panel">
        <form method="get" action="">
            <div class="input-field col s6">
                <input value="<?php echo ($_GET['code']); ?>" name="code" id="first_name" type="text" class="validate">
                <label for="first_name">在这里输入兑换码</label>
            </div>
            <!---->
            <button type="submit" class="waves-effect btn" style="width: 100%">查询</button>
        </form>
    </div>
</div>

<!-- 列表 -->
<?php if (isset($_GET['code']) && $_GET['code']) { ?>
<!-- 如果有获取到code 显示所有 -->
<div style="margin: 10px;">
    <ul class="collection white card-panel">
        <?php  if ($list && count($list)) { foreach($list as $vo) { ?>

        <!-- 列表元素 -->
        <li data-id="<?php echo ($vo['exrid']); ?>" class="collection-item avatar">
            <!-- 图像 -->
            <img src="<?php echo ($vo['img']); ?>" alt="" class="circle">
            <!-- 标题 -->
            <span class="title">订单id:<?php echo ($vo['exrid']); ?> </span>
            <p>兑换了 <font class="blue-text"><?php echo ($vo['num']); ?></font> 个 <font class="blue-text"><?php echo ($vo['name']); ?></font><br>
                兑换时间: <?php echo ($vo['time']); ?>
            </p>

            <?php if($vo['status']): ?>处理人: <?php echo ($vo['adm']); ?><br>
                处理人备注: <?php echo ($vo['remark']); ?><br>
                领取时间: <?php echo ($vo['finish']); ?><br>
                <span class="secondary-content" style="color: #999999">已领取</span>
                <?php else: ?>
                <a href="#modal1" class="secondary-content">点击确认领取</a><?php endif; ?>
        </li>

        <?php } } else { ?>

        <!-- 兑换码搜索结果为空 -->
        <div class="center-align">兑换码 <span class="red-text"><?php echo ($_GET['code']); ?></span> 不存在,请检查是否有输入错误</div>

        <?php } ?>
    </ul>
</div>

<?php } ?>

<div id="modal1" class="modal">
    <div class="modal-content">
        <h5>请确认</h5>
        <div class="input-field">
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">可以在这里输入备注信息,选填</label>
        </div>
        <p class="red-text right-align">* 点击确定后,就无法取消,请谨慎操作</p>
    </div>
    <div class="modal-footer">
        <a id="confirm" class="modal-action modal-close waves-effect waves-green btn-flat">确定</a>
    </div>
</div>

<div id="modal2" class="modal">
    <div class="modal-content">
        <p class="center-align">
            <!--返回信息-->
        </p>
    </div>
    <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-green btn-flat">确定</a>
    </div>
</div>


<script>
    $(document).ready(function($){
        // 初始化模态
        $('.modal').modal();
        // $('#modal1').modal('open');
        // $('#modal1').modal('close');

        // 点击标记为 "已领取"时的动作
        $("[href='#modal1']").click(function () {
            var id = $(this).closest('[data-id]').data('id');
            $('#modal1').data('id',id);
            console.log(id);
        });

        // 确定
        var ajaxLock = false;
        $('#confirm').click(function () {
            Materialize.toast('正在处理中,请稍候...', 2000);
            if (!ajaxLock) {
                ajaxLock = true;
                $.ajax({
                    url     : "<?php echo U('finish');?>",
                    data    : {
                        id      :   $('#modal1').data('id'),
                        remark  :   $('#textarea1').val()
                    },
                    type    : 'post',
                    dataType: 'json',
                    success : function (obj) {
                        console.log(obj);
                        if (obj.status) {
                            // 成功提示
                            $('#modal2').find('a').click(function () {
                                location.reload();
                            });
                            $('#modal2').data('status',obj.status).modal('open');
                            $('#modal2').find('p').text(obj.info);
                            // 免除点击消失
                            $('.modal-overlay').unbind('click');
//                            alert(obj.info);
//                            location.reload();
//                            Materialize.toast('<font class="green-text">'+obj.info+'</font>', 4000);
                        }
                        else {
                            // 失败提示
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
</body>
</html>