<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>来试下自己的手速有多快?</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="__PUBLIC__/css/materialize.min.css">

    <!--<script src="__PUBLIC__/js/web_socket.js"></script>-->
    <!--<script src="__PUBLIC__/js/swfobject.js"></script>-->

    <script src="__PUBLIC__/js/fastclick.js"></script>
    <script src="__PUBLIC__/js/jquery-2.2.0.min.js"></script>
    <script src="__PUBLIC__/js/materialize.min.js"></script>
</head>

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

    .row,.col {
        margin: 0;
        padding: 0;
    }
    .col {
    }
    #c {
        width: 50px;
        height: 50px;
    }
    table {
        width: 300px;
        margin: 50px auto;
        opacity: 0;
    }
    table>tbody>tr>td {
        /*border: 1px solid #333333;*/
        height: 100px;
        position: relative;
    }

    table>tbody>tr>td>div {
        position: absolute;
        /*display: none;*/
        top: 0;
        left: 0;
        height: 90%;
        width: 90%;
        background-color: #FFFFFF;
        border-radius: 2px;
        box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2);
    }
    table>tbody>tr>td>div:active {
        box-shadow:none;

    }
    .normal:active {
        background-color: red;
    }

    .normal:active:after {
        content: "×";
        color: #fff;
        font-size: 50px;
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
    }

    /* 正常 */
    .active {
        background-color: #03a9f4;
    }
    .active:after {
        content: "+1";
        color: #fff;
        font-size: 50px;
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
    }
    .active:active:after {
        content: "+1";
    }
    .active:active {
        background-color: #8bc34a;
    }

    /* 幸运 */
    .lucky {
        background-color: #ffeb3b;
    }
    .lucky:after {
        content: "+5";
        color: #fff;
        font-size: 50px;
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
    }
    .lucky:active:after {
        content: "+5";
    }
    .lucky:active {
        background-color: #8bc34a;
    }


    /* 厄运 */
    .unlucky{
        background-color: #212121;
    }
    .unlucky:after {
        content: "-1";
        color: #fff;
        font-size: 50px;
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
    }
    .unlucky:active:after {
        content: "-1";
    }
    .unlucky:active {
        background-color: #9c27b0;
    }

</style>
<body>
<?php if ($error) { ?>
<h5 class="row center-align" style="margin-top: 20px;"><?php echo ($error); ?></h5>
<?php exit; } ?>
<h4 class="center-align" style="margin-top: 20px;">
    得分:<span id="score" class="green-text">0</span>
    错误:<span id="error" class="red-text">0</span>
</h4>

<!--<a class="light-green waves-effect waves-light btn" style="width: 100%">开始游戏</a>-->
<table>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <div id="res" style="display: none">
            <p class="res-msg center-align"></p>
            <a href="<?php echo U('game');?>" class="orange lighten-1 waves-effect waves-light btn" style="width: 100%">继续挑战</a>
            <a href="<?php echo U('gameInfo');?>?id=<?php echo ($yb_userid); ?>" class="light-green waves-effect waves-light btn" style="width: 100%;margin-top: 10px;">查看我的记录</a>
            <a href="<?php echo U('rank');?>" class="light-green waves-effect waves-light btn" style="width: 100%;margin-top: 10px;">查看广药"手速"排行榜</a>
        </div>
        <div id="loading" style="display: none">
            <p class="res-msg center-align">错误次数已达3次，游戏结束，正在保存成绩,请稍后...</p>
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
        <div id="check">
            <p class="res-msg center-align">您的成绩过高,为防止作弊行为,请输入验证码</p>
            <div class="row">
                <div class="col s6"><input id="v_in" placeholder="验证码"/></div>
                <div class="col s6">
                    <img id="v_img" style="width: 100%;height: 100%;" src="<?php echo U('verify');?>" onclick="this.src=this.src+'?'+Math.random();"/>
                </div>
            </div>
            <p class="red-text" style="display: none">验证码错误,请重新输入</p>
            <a id="v_sub" class="light-green waves-effect waves-light btn" style="width: 100%;">提交</a>
        </div>
    </div>
    <!--<div class="modal-footer">
        <a class=" modal-action modal-close waves-effect waves-green btn-flat">确定</a>
    </div>-->
</div>
<div class="row">
    <div class="center-align">广东药科大学易班学生工作站提供技术支持</div>
</div>
<script>

</script>
<script>
    //WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
    //WEB_SOCKET_DEBUG = true;




    jQuery(document).ready(function ($) {

        $('.modal').modal({
            dismissible: false
        });

        var
                verify = '',
                rand = 0,
                status = 'active',
                gameOver = false,
                runSpeed = parseInt('900'),
                delay = parseInt('850'),
                showSpeed = parseInt('50'),
                score = 0,
                error = 0,
                maxError = parseInt('3'),
                reduceStep = parseInt('50'),
                token = '<?php echo ($token); ?>',
                minRand = 1,
                maxRand = 9;
        /**
         * 初始化游戏
         */
        var init = function () {
            var index = 1;
            td.each(function () {
                $(this).empty().append('<div class="normal"></div>').find('.normal')
                        .data('index',index++)
                        .on('click',function () {
                            $(this).removeClass(status);
                            var index = $(this).data('index');
                            if (rand == index) {
                                oncurrect();
                            }
                            else {
                                onerror();
                            }
                        });
            });

        };

        /**
         * 游戏运行
         */
        var run = function () {
            if (gameOver) {
                // 游戏结束
            }
            else {
                onchange();
                setTimeout(run,runSpeed);
            }
        };

        /**
         * 变换随机数触发的事件
         */
        var resetrand = function() {
            var _rand;
            while ( rand == (_rand = RandomNumBoth(minRand,maxRand)) );
            rand = _rand;
        };

        /**
         * 重置状态
         */
        var resetstatus = function () {
            var _status = RandomNumBoth(1,10);
            if (_status <= 1) {
                status = "unlucky";
            }
            else if (_status >= 2 && _status <= 3) {
                status = "lucky";
            }
            else {
                status = "active";
            }
        };

        /**
         * 改变时的回调
         */
        var onchange = function () {
            // 取消方块
            td.eq(rand-1).find('div').eq(0).removeClass(status);

            //  重新获取 rand
            resetrand();
            // 重新获取active
            resetstatus();

            // 显示方块
            td.eq(rand-1).find('div').eq(0).addClass(status);
        };

        /**
         * 正确时的回调函数
         */
        var oncurrect = function () {
            if (gameOver) return;

            switch (status) {
                case 'active':
                    score++;
                    break;
                case 'lucky':
                    score+=5;
                    break;
                case 'unlucky':
                    score--;
                    break;
            }
            $('#score').text(score);
            runSpeed -= reduceStep;
            delay -= reduceStep;
        };

        /**
         * 点错时的回调函数
         */
        var onerror = function () {
            if (gameOver) return;

            if (++error >= maxError){
                onover();
            }

            $('#error').text(error);
        };


        $('#v_sub').click(function () {
            verify = $('#v_in').val();
            $('#modal1').find('#loading').show();
            $('#modal1').find('#check').hide();
            onsubmit();
        });
        var _alert = function (msg) {
            $('#modal1').modal('open');

            if (msg) {
                $('#modal1').find('#res').show().find('p').text(msg);
                $('#modal1').find('#loading').hide();
                $('#modal1').find('#check').hide();
            }
            else if (score >= parseInt('<?php echo ($check); ?>')) {
                //
            }
            else {
                $('#modal1').find('#check').hide();
                $('#modal1').find('#loading').show();
            }
            // 免除点击消失
            $('.modal-overlay').unbind('click');
        };

        /**
         * 游戏结束时的回调函数
         */
        var onover = function () {
            _alert();
            gameOver = true;
            $('.normal').attr('class','normal');

            if (score < parseInt('<?php echo ($check); ?>')) {
                onsubmit();
            }
        };

        /**
         * 提交成绩时的回调函数
         */
        var onsubmit = function () {
            $.ajax({
                url     : "<?php echo U('updScore');?>",
                data    : {
                    s:score,
                    t:token,
                    v:verify
                },
                type    : 'post',
                dataType: 'json',
                success : function (obj) {
                    console.log(obj);
                    if (obj.status == -1) {
                        $('#modal1').find('#check').show();
                        $('#modal1').find('#loading').hide();
                        $('#check').find('.red-text').show();
                        $('#v_img').click();
                    }
                    else {
                        _alert(obj.info);
                    }

                },
                error   : function () {
                },
                complete: function () {
                }
            });
        };

        var RandomNumBoth = function(Min,Max){
            var Range = Max - Min;
            var Rand = Math.random();
            return Min + Math.round(Rand * Range); //四舍五入
        };

        var time = function() {
            var tmp = Date.parse( new Date() ).toString();
            tmp = tmp.substr(0,10);
            return tmp;
        };




        FastClick.attach($('table').css('opacity',1)[0]);

        var td = $('td');



        init();

        run();

















        return;

        /*var ws = new WebSocket("ws://123.207.121.88:7272");
        ws.sendData = function (type,data) {
            if (!data) {
                data = {};
            }
            data['type'] = type;
            this.send(JSON.stringify(data));
            return data;
        };
        ws.onopen = function (e) {
            ws.sendData('login',{'uid':'1','token':'123'});
        };
        ws.onmessage = function (e) {
            var msg = JSON.parse(e.data);
            console.log(msg,Date.now());
            switch (msg.type) {
                // 服务器发送通知
                case "test":
                    // 提示服务器进行测试
                    ws.sendData('test');
                    break;
                case "start":
                    // 初始化游戏环境
                    init();
                    break;
                case 'rand':
                    // 显示方块 (取代run 函数)
                    change(msg.randNum,msg.delay);
                    break;
                // 点击返回的结果
                case 'result':
                    if (msg.queue) {
                        var q = msg.queue;
                        for (var j=0; j<q.length; j++) {
                            if (msg.clickNum == q[j].num) {
                                q[j]['time>=start'] = msg.clickTime >= q[j].start;
                                q[j]['time<=end'] = msg.clickTime <= q[j].end;
                                //clickTime q[j].start q[j].end
                            }
                        }
                    }
                    switch (msg.result) {
                        case 1:
                            $('#score').text(parseInt($('#score').text())+1);
                            break;
                        case -1:
                        case 0:
                            $('#error').text(parseInt($('#error').text())+1);
                            break;

                    }
                    // 正确+1 or 错误+1 or 游戏结束
                    break;
                case 'warn':
                    break;
                case 'error':
                    switch (msg.code) {
                        case 4:
                            if (confirm(msg.info)) {
                                init();
                                break;
                            }
                        default:
                            ws.close();
                            alert(msg.info);

                    }
                    break;

                default:
            }
        };

        ws.onerror = function(e){
            console.log('websocked error',e);
        };
        ws.onclose = function(e) {
            console.log("Connection closed", e);
        };*/


    });
</script>
</body>
</html>