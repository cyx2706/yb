<?php

/**
 * Class TempAction 临时活动页面
 */
class TempAction extends CommonAction {

    public function recruit() {
        $this->display();
    }

    public function sub() {
        //header('Content-type:text/Html;charset=UTF-8');
        if ($_POST) {
            $data = null;
            $info = '';
            $status = false;
            $M = D('Recruit');
//            if($_SESSION['verify'] != md5($_POST['verify'])) {
//                $info = '请输入正确的验证码哦';
//                $data = array($_SESSION['verify'],md5($_POST['verify']));
//            }else
                if ($data = $M->create()) {
                    if ($M->add()) {
                        $info = '非常感谢您对我们的认可,我们会以短信or电话的方式联系您,面试要加油哦!';
                        $status = true;
                    }
                    else {
                        $data = array($_POST,$data);
                        $info = 'OOOOOH! 出错了...要不到我们一二饭摊位提交纸质版报名表吧,随时欢迎你哦';
                    }
                }
                else {
                    $info = $M->getError();
                }
            $this->ajaxReturn($data,$info,$status);
        }
        else {
            $this->ajaxReturn(0,'OOOOOH! 发生错误了...',false);
        }
    }

    Public function getVerify(){
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }

    public function getAll() {
        // 更改数据库
        C('DB_HOST','120.24.45.27');
        C('DB_USER','cyx2706');
        C('DB_PWD','yiban_2017_3_4');

        header('Content-type:text/Html;charset=UTF-8');
        $table = M('Recruit')->order('id')->select();
        $table = M('Recruit')->order('id')->select();

        foreach ($table as &$data) {
            $data['depart'] = implode(',',json_decode($data['depart'],true));
        }

        //dump($table);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new PHPExcel();
        $activeSheet = $objPHPExcel->getActiveSheet();
        $setActiveSheet = $objPHPExcel->setActiveSheetIndex(0);

        $dataStartRow = 0;
        foreach ($table as $dataRow) {
            $dataStartCol = 0;
            foreach ($dataRow as $field) {
                $setActiveSheet->setCellValue($this->getCellName($dataStartCol++,$dataStartRow), $field);
            }
            $dataStartRow++;
        }

        $fileName = '线上报名表';
        $xlsTitle = iconv('utf-8', 'gb2312', $fileName);
        // 输出文件
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    // 十进制数字转26进制字符串
    private function getColName($col) {
        $s = '';
        $col++;
        while ($col > 0){
            $m = $col % 26;
            if ($m == 0) $m = 26;
            $s = chr($m + 64).$s;
            $col = ($col - $m) / 26;
        }
        return $s;
    }

    private function getCellName($col,$row) {
        return $this->getColName($col).($row+1);
    }

    public function exchange2() {
        $this->display();
    }


    private $check = 70;

    /**
     * session 保存uid
     * session 保存token
     */
    public function game() {
        if (get_client_ip() != '127.0.0.1' && !$this->isLog()) {
            header('Location:https://openapi.yiban.cn/oauth/authorize?'.
                'client_id='.C('YB_APP_ID').
                '&redirect_uri='.C('YB_CB_URL').
                '&state='.'Temp/game');
            exit;
        }
        if (get_client_ip() != '127.0.0.1' && !$this->isMobile()) {

            throw new Exception("请使用手机或其他移动设备打开该页面");
        }
        elseif (get_client_ip() != '127.0.0.1' && $this->getUser('yb_schoolname') != '广东药科大学') {

            //$this->assign('error',"本游戏只对广东药科大学易班用户开放,请检查自己是否已经完成校方认证 或 认证学校是否为广东药科大学");
        }
        else {
        }
        $this->assign('check',$this->check);
        $this->assign('token',$this->getToken());
        $this->assign('yb_userid',$this->getUser('yb_userid'));

        $this->display();
    }

    private function getToken() {
        return $_SESSION['token'] = md5('dsfjsdfjjsdis覅.+-*/'.time().rand());
    }

    public function _rank() {
        $rankNum = 4;
        $this->assign('rankNum',$rankNum);

//        $dataSql = M('GameRecords')
//            ->alias('GR')
//            //->join('user AS USR ON USR.yb_userid = GR.yb_userid')
//            ->group('GR.yb_userid')
//            ->order('MAX(GR.score)')
//            //->field('grid,nick,MAX(GR.score) as max_scr,yb_userhead,GR.time')
//            ->field('MAX(GR.score) as max_scr,GR.yb_userid')
//            ->limit($rankNum)
//            ->select(false);
//        $M = M();

//        $list = $M->query("SELECT data.* FROM $dataSql data WHERE data.");
//        /*$list = $M->query("select data.*
//                    , @r1:=@r1+1 as rank
//                    , @r:=if(@p=max_scr ,@r,@r1) as coordinate_rank
//                    , @p:=max_scr
//                from $dataSql data,(select @r:=0) as b,(select @r1:=0) as c, (select @p:=null) as d
//                order by max_scr desc,time asc
//                LIMIT 20");*/
//        dump($M->getDbError());
//        dump($list);

        $M = M('GameRecords');

        $scoreList = M('GameRecords')
            ->alias('GR')
            ->group('GR.score')
            ->order('GR.score desc')
            ->field('MAX(GR.score) as val,COUNT(GR.score) AS cnt')
            ->limit($rankNum)
            ->select();

        $list = array();
        $counter = 0;
        foreach ($scoreList as $score) {
            if ($counter >= $rankNum) {
                break;
            }


            $counter += $score['cnt'];

            $M = $M
                ->alias('GR')
                ->join('user AS USR ON USR.yb_userid = GR.yb_userid')
                ->where(array('score'=>array('eq',$score['val'])))
                ->field('yb_userhead,nick,score,UNIX_TIMESTAMP(GR.time) as time')
                ->order('GR.time asc');
            if ($counter > $rankNum) {
                $M = $M->limit($score['cnt'] - ($counter-$rankNum));
            }

            $listInScore = $M
                ->select();
            $list = array_merge($list,$listInScore);
        }



        foreach ($list as $k=>&$item) {
            $item['rank'] = $k+1;
            $item['time'] = date('m月d日 H:i:s',$item['time']);
        }


        $this->assign('list',$list);

        $this->display();
    }

    public function rank() {

        // 最多显示20个
        $rankNum = 20;

        $this->assign('rankNum',$rankNum);
        $M = M('GameRecords');
        $listSql = $M
            ->alias('GR')
            ->join('user AS USR ON USR.yb_userid = GR.yb_userid')
            ->order('score desc,time asc')
            ->field('GR.yb_userid,yb_userhead,nick,score,GR.time')
            ->select(false);


        $list = $M->query("select @rownum:=@rownum+1 AS rank,data.*
                    from $listSql data,(SELECT @rownum:=0) r
                    LIMIT $rankNum");

        foreach ($list as $k=>&$item) {
            //$item['rank'] = $k+1;
            $item['time'] = date('m月d日 H:i:s',strtotime($item['time']));
        }

        if (get_client_ip() == '127.0.0.1' || $this->isLog()) {

            $yb_userid = $this->getUser('yb_userid');
            if (get_client_ip() == '127.0.0.1') {
                $yb_userid = '1500502118';
            }
            $this->assign('yb_userid',$yb_userid);
        }


        $this->assign('list',$list);

        $this->display();

    }

    public function gameInfo() {
        $yb_userid = 0;
        if (isset($_GET['id']) && ($yb_userid = (int)$_GET['id'])) {
            $this->assign('rec',$this->getUserRec($yb_userid));
            $this->assign('yb_userid',$yb_userid);

            if (get_client_ip() == '127.0.0.1' || $this->isLog()) {

                $yb_userid = $this->getUser('yb_userid');
                if (get_client_ip() == '127.0.0.1') {
                    $yb_userid = '1500502118';
                }
                $this->assign('my_userid',$yb_userid);
            }
        }


        $this->display();
    }

    /*移动端判断*/
    private function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * 更新成绩
     */
    public function updScore() {
        if (time()>=strtotime('2017-11-13')) {
            $this->ajaxReturn(0,'本活动已结束,该次分数无效(活动时间为11月11日-11月12日23:59:59)',false);
        }
        if (get_client_ip() != '127.0.0.1' && !$this->isLog()) {
            $this->ajaxReturn(0,'请先登录',false);
        }

        elseif (get_client_ip() != '127.0.0.1' && $this->getUser('yb_schoolname') != '广东药科大学') {
            // $this->ajaxReturn(0,'本游戏只对广东药科大学易班用户开放,请检查自己是否已经完成校方认证 或 认证学校是否为广东药科大学',false);
        }
        $verify = $_POST['v'];
        $token = $_POST['t'];//前端post的token
        $score = (int)$_POST['s'];

        // 如果超过检验的阀值
        if ($score>=$this->check) {

            // 检验验证码输入字符串
            if (!$this->check_verify($verify)) {
                foreach ($_SESSION as $k=>$se) {
                    if (strlen($k)>=32) {
                        unset($_SESSION[$k]);
                    }
                }
                $this->ajaxReturn(0,'您输入的验证码有误',-1);
            }
        }

        // 检验token
        if ($token != $_SESSION['token']) {
            // 重置token防止暴力破解
            $this->getToken();
            $this->ajaxReturn(0,'数据提交错误(提示:token错误)',false);
        }
        unset($_SESSION['token']);


        $yb_userid = $this->getUser('yb_userid');
        if (get_client_ip() == '127.0.0.1') {
            $yb_userid = '1500502118';
        }



        $M = M('GameRecords');
        $rec = $M->find($yb_userid);
        $maxScore = $score;
        if ($rec) {
            if ($rec['score']<$score) {
                $status = $M
                    ->where(array('yb_userid'=>array('eq',$yb_userid)))
                    ->save(array(
                        'score'=>$score,
                        'time'=>date('Y-m-d H:i:s')));
                if ($status) {
                    $status = 2;
                }
            }
            else {
                $maxScore = $rec['score'];
                $status = 1;
            }
        }
        else {
            $status = $M->add(array(
                'yb_userid'=>$yb_userid,
                'score'=>$score,
            ));
            if ($status) {
                $status = 2;
            }
        }
        $this->ajaxReturn(0,$status?'成绩保存成功,您的最高成绩为'.$maxScore.'分':'成绩保存失败,请联系广药易班人员',$status);
    }

    private function getUserRec($yb_userid) {

        $M = M('GameRecords');
        $listSql = $M
            ->alias('GR')
            ->join('user AS USR ON USR.yb_userid = GR.yb_userid')
            ->order('score desc,time asc')
            ->field('GR.yb_userid,yb_userhead,nick,score,GR.time')
            ->select(false);

        $user = $M->query("SELECT *
                            FROM(select @rownum:=@rownum+1 AS rank,data.*
                                          from $listSql data,(SELECT @rownum:=0) r) list
                            WHERE yb_userid = '$yb_userid'");
        return $user[0];
    }

    /**
     * 获取验证码
     */
    public function verify(){
        import('@.Widget.Verify');
        $Verify = new Verify(array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
        ));
        $Verify->entry();
        //import('ORG.Util.Image');
        // Image::buildImageVerify();
    }

    private function check_verify($code, $id = ''){
        import('@.Widget.Verify');
        $Verify = new Verify();
        return $Verify->check($code, $id);
    }

}