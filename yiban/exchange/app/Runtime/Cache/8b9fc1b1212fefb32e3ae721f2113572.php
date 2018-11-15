<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网薪兑换 | 反馈收集</title>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">
    <link rel="stylesheet" href="__PUBLIC__/css/common.materialize.css">

    <!-- jQuery -->
    <script src="__PUBLIC__/js/jquery-2.2.0.js"></script>

    <script src="__PUBLIC__/js/materialize.min.js"></script>
</head>
<body>
<div class="container">
    <div class="card none-box-shadow">
        <div class="card-content" style="padding: 10px;">

            <form>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="question" id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">在这里写需要反馈的bug或内容,我们会在24小时内作出回复</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input name="verify" id="first_name" type="text" class="validate">
                        <label for="first_name">验证码</label>
                    </div>
                    <div class="col s6">
                        <img id="verify_img" src="<?php echo U('verify');?>" style="width: 100%;max-width: 135px;">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">

                        <a id="sub" class="waves-effect yellow black-text btn" style="width: 100%">提交</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="card none-box-shadow">
            <div class="card-content" style="padding: 10px;">

                <div class="row">
                    <div class="col s12">
                        <b class="cyan-text text-lighten-4">Q:</b> <?php echo ($vo["question"]); ?>
                    </div>
                </div>

                <?php if ($vo['answer']) { ?>
                <div class="row">
                    <div class="col s12">
                        <b class="yellow-text">A:</b> <?php echo ($vo["answer"]); ?>
                    </div>
                </div>
                <?php } ?>
                <div class="right-align"><?php echo ($vo["time"]); ?></div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<div id="modal1" class="modal">
    <div class="modal-content">
        <p class="center-align"></p>
    </div>
    <div class="modal-footer">
        <a id="confirm" class="modal-action modal-close waves-effect waves-green btn-flat">确定</a>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.modal').modal();

        $('#verify_img').click(function () {
            $(this).attr('src',"<?php echo U('verify');?>"+"?"+Math.random());
        });

        var ajaxLock = false;
        $('#sub').click(function () {
            if (!ajaxLock) {

                ajaxLock = true;

                $.ajax({
                    url     : "<?php echo U('add');?>",
                    data    : $('form').serialize(),
                    type    : 'post',
                    dataType: 'json',
                    success : function (obj) {
                        if (obj.status) {
                            // 成功
                            $('#confirm').click(function () {
                                location.reload();
                            });
                        }
                        else {
                            // 失败更换验证码
                            $('#verify_img').click();
                        }
                        $('#modal1').find('.center-align').text(obj.info);
                        $('#modal1').modal('open');
                        $('.modal-overlay').unbind('click');
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