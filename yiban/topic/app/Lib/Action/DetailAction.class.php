<?php
class DetailAction extends CommonAction {

    public function getTopic() {
        $tid = (int)$_GET['id'];
        $topic = M('Topic')->find($tid);

        // 处理
        if (!$topic || !$topic['status']) {
            $topic['title'] = 'oh，内容已经被删除了...';
            $topic['content'] = '<div style="text-align: center"><a href="'.U('Index/index').'">&gt;&gt;点击这里查看更多有趣话题</a></div>';
        }

        //sleep(1);
        $this->ajaxReturn($topic);
    }

    /**
     * $_GET['page']
     * $_GET['fst']
     * $_GET['tid']
     */
    public function loadComments() {
        $maxNum     =  C('CMMNT_NUM_A_PAGE');
        $page       = (int)$_GET['page'];
        $firstId    = (int)$_GET['fst'];
        $tid        = (int)$_GET['tid'];

        $Model      = M('Comment');
        $condition  = "tid = '$tid'";
        $condition .= ' AND user.status > 0';

        // 所以这里判断用户权限然后决定是否添加限制条件
        // 正常用户只可以看见没有屏蔽的
        if (!$this->isAdm()) {
            $condition .= ' AND CMMNT.status > 0';
        }
        // 管理员可以看见所有的
        else {
            $condition .= ' AND CMMNT.status >= 0';
        }

        // 保持每次加载都是在当时第一次加载id的
        if ($page > 1 && $firstId > 0) {
            $condition .= " AND CAST(`cmid` AS UNSIGNED INTEGER) <= $firstId";
        }

        // 数据应该右连接用户的
        $data =
            $Model->
            alias('CMMNT')->
            // 显示评论图片
            join('LEFT JOIN img ON img.imgid = CMMNT.imgid')->
            // 如果用户不存在就不显示(或者被封禁)
            join('RIGHT JOIN user ON user.uid = CMMNT.uid')->
            // 如果@的用户不存在就显示空
            //join('LEFT JOIN user AS TUSR ON TUSR.uid = CMMNT.touid')->
            // 不显示被屏蔽的
            where($condition)->
            field('cmid,CMMNT.uid,CMMNT.addtime,content,nick,src,CMMNT.status,recmmd,user.status as usr_status,touid,yb_userhead')->
            order('CMMNT.addtime DESC,CMMNT.cmid DESC')->
            page($page.','.$maxNum)->
            select();

        $err = $Model->getDbError();

        if ($err) {
            //log
        }

        //sleep(1);
        $this->ajaxReturn($data);
    }

    /**
     * $_GET['tid'];
     */
    public function loadHotComments() {
        $tid        = (int)$_GET['tid'];

        $Model      = M('Comment');
        $condition  = "tid = '$tid'";
        $condition .= ' AND CMMNT.recmmd > 0';
        $condition .= ' AND user.status > 0';

        if (!$this->isAdm()) {
            $condition .= ' AND CMMNT.status > 0';
        }
        // 管理员可以看见所有的
        else {
            $condition .= ' AND CMMNT.status >= 0';
        }

        $data =
            $Model->
            alias('CMMNT')->
            // 显示评论图片
            join('LEFT JOIN img ON img.imgid = CMMNT.imgid')->
            // 如果用户不存在就不显示(或者被封禁)
            join('RIGHT JOIN user ON user.uid = CMMNT.uid')->
            // 如果@的用户不存在就显示空
            //join('LEFT JOIN user AS TUSR ON TUSR.uid = CMMNT.touid')->
            // 不显示被屏蔽的
            where($condition)->
            field('cmid,CMMNT.uid,CMMNT.addtime,content,nick,src,CMMNT.status,recmmd,user.status as usr_status,touid,yb_userhead')->
            //order('CMMNT.addtime DESC,CMMNT.cmid DESC')->
            select();


        $this->ajaxReturn($data);
    }
}
?>