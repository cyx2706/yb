<?php
class HomeAction extends Action {

    /**
     * 前端get参数如下
     * page 表示加载第几页
     */
    public function load() {
        $topicModel = M('Topic');

        $condition = array();

        // 正常用户只可以看见没有屏蔽的
        // 管理员可以看见所有的,所以这里判断用户权限然后决定是否添加限制条件
        if (1) {
            $condition['TPC.status'] = array('gt',0);
        }
        $condition['VU.vuid'] = array('gt',0);

        // 数据应该右连接用户的
        // 前端通过判断用户的身份状态决定是否显示文章, 怎样显示(官方公众号颜色特别)
        $data =
            $topicModel->
            alias('TPC')->
            join('RIGHT JOIN user USR ON USR.uid=TPC.uid')->
            join('LEFT JOIN virtual_user VU ON VU.uid=TPC.uid')->
            field('tid,USR.status,TPC.uid,title,content,TPC.addtime,TPC.updtime,USR.nick,USR.yb_userhead,VU.vuid')->
            where($condition)-> // 不显示被屏蔽的
            order('TPC.updtime DESC,TPC.tid DESC')->
            page((int)$_GET['page'].','.C('TOPIC_NUM_A_PAGE'))->
            select();

        $err = $topicModel->getDbError();

        if ($err) {
            //log
        }
        $this->ajaxReturn($data);

    }
}