<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欢迎加入易班学生工作站</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">
    <script src="__PUBLIC__/js/jquery-2.2.0.js"></script>
    <script src="__PUBLIC__/js/materialize.min.js"></script>
</head>
<style>
    html,body {
        height: 100%;
    }
    body {
        background-color: #fcfcfc;
        background-color: #efebe9;
        background-color: #f8f8f8;
    }
    .introduce li {
        padding: 5px 0;
    }
</style>
<body>
<div class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">易班学生工作站</h5>
                <p class="grey-text text-lighten-4">
                    相比起“校一级组织”这个标签，我们更像一个初创的工作室。与其成立一个传统的一级学生组织，还不如建立一个能够倾听每一个人的声音的平台。这里没有严肃的氛围，也没有高冷的会长，只有喜欢搞事情的一群人。我们讨厌死板又形式化的活动，立志要用自己无限的脑洞给予大家不一样的广药生活；我们抱着大胆无畏的决心，决意要将“互联网+”带入广药校园。
                </p>
            </div>
            <!--<div class="col l4 offset-l2 s12">
                <h5 class="white-text">相关介绍</h5>
                <ul class="introduce">
                    <li><a class="grey-text text-lighten-3" href="http://mp.weixin.qq.com/s/m-r023oH10LTW5tmcSEDgg">易班是什么?老司机带你探探路!</a></li>
                    <li><a class="grey-text text-lighten-3" href="http://mp.weixin.qq.com/s/UDhvV00GTgzRSu6Ksv5V-A">震惊!!!使用易班居然可以免费获取礼物?</a></li>
                    <li><a class="grey-text text-lighten-3" href="http://mp.weixin.qq.com/s/MYEpCSqZvr9h4hNzRpslXw">易班学生工作站是什么?</a></li>
                    &lt;!&ndash;<li><a class="grey-text text-lighten-3" href="#!">到底什么部门适合我呢?</a></li>&ndash;&gt;
                </ul>
            </div>-->
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            ↓ 报名表格在下面哦 ↓
            <!--<span class="new badge" data-badge-caption="关注我们"></span>-->
            <!--<a class="waves-effect waves-light btn right" style="padding: 0;font-size: 14px;">＋关注我们</a>-->
            <!--<a class="white-text right" href="http://weixin.qq.com/r/nyn-5-HED6xwrbWE93yN">戳这里关注我们</a>-->
        </div>
    </div>
</div>
<!--
学院 班级 姓名 联系方式 意向部门 爱好(非必要) 自我介绍(非必要) 照片选填 是否服从调剂
-->
<div class="row" style="margin-top: 10px;">
    <form class="col s12" method="post" action="<?php echo U('sub');?>">
        <!-- 学院 -->
        <div class="row">
            <div class="input-field col s12">
                <input id="college" name="college" type="text" class="validate">
                <label for="college">学院</label>
            </div>
        </div>

        <!-- 班级,姓名 -->
        <div class="row">
            <div class="input-field col s7">
                <input id="class" name="class" type="text" class="validate">
                <label for="class">班级</label>
            </div>
            <div class="input-field col s5">
                <input id="name" name="name" type="text" class="validate">
                <label for="name">姓名</label>
            </div>
        </div>


        <!-- 联系电话 -->
        <div class="row">
            <div class="input-field col s12">
                <input id="phone" name="phone" type="text" class="validate">
                <label for="phone">联系电话</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
            请选择意向部门
            </div>
        </div>
        <!--选择部门-->
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart1" name="depart[]" value="副会长"/>
                <label for="depart1">副会长(没有人天生具有领导能力,都是锻炼出来的)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart2" name="depart[]" value="新媒体"/>
                <label for="depart2">新媒体运营小组(你离大V就这么一点距离了)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart3" name="depart[]" value="网薪"/>
                <label for="depart3">网薪兑换运营小组(网薪兑换实物你说了算!)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart4" name="depart[]" value="综合部"/>
                <label for="depart4">综合部(社团大管家)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart5" name="depart[]" value="策划推广部"/>
                <label for="depart5">策划推广部(懂PS懂设计懂策划,hin有想法)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart6"  name="depart[]" value="采编部"/>
                <label for="depart6">采编部(成为公众号运营大神的第一步)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart7" name="depart[]" value="外联部"/>
                <label for="depart7">外联部(对外宣传,拉取赞助)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart8" name="depart[]" value="技术部(UI设计)"/>
                <label for="depart8">技术部(网页设计组)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart9" name="depart[]" value="技术部(前端)"/>
                <label for="depart9">技术部(前端开发组)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="depart10" name="depart[]" value="技术部(后台)"/>
                <label for="depart10">技术部(后台开发组)</label>
            </div>
        </div>


        <!-- 服从分配 -->
        <div class="row"  style="margin-bottom: 50px;">
            <div class="input-field col s12">
                <div class="switch">
                    <label>
                        不服从调剂
                        <input type="checkbox" name="obey">
                        <span class="lever"></span>
                        服从调剂
                    </label>
                </div>
            </div>
        </div>

        <!-- 个人爱好 -->
        <div class="row">
            <div class="input-field col s12">
                <input id="hobby" name="hobby" type="text" class="validate">
                <label for="hobby">爱好(选填)</label>
            </div>
        </div>

        <!-- 自我介绍(非必要,不要超过1000字哦) -->
        <div class="row">
            <div class="input-field col s12">
                <textarea id="textarea1" name="introduction" class="materialize-textarea"></textarea>
                <label for="textarea1">自我介绍(选填,不要超过1000字哦)</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <a id="sub" class="waves-effect waves-light btn" style="width: 100%">提交</a>
            </div>
        </div>
    </form>
</div>
<div class="row" style="padding-bottom: 20px;">
    <div class="col s12 center-align" style="color: #999999;">
        <font color="#ee6e73">广东药科大学易班学生工作站</font><br>
        提供技术支持
    </div>
</div>
<script>
    jQuery(document).ready(function ($) {
        var ajaxLock = false;
        $('#sub').click(function () {
            if (!ajaxLock) {
                $.ajax({
                    url : $('form').attr('action'),
                    type : $('form').attr('method'),
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
                        console.log(obj);
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