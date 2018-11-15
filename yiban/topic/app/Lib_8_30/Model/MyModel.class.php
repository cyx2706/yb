<?php
class MyModel extends Model {

    protected $autoCheckFields = false;

    protected $conn = null;

    public function __construct() {
        // 先执行父类构造函数
        parent::__construct();
        $this->initConn();
    }

    public function __destruct() {
        $this->closeConn();
        //parent::__destruct();
    }

    /**
     * 初始化数据库
     */
    public function initConn() {
        //$dbtype     = C('DB_TYPE');
        $host       = C('DB_HOST');
        $dbname     = C('DB_NAME');
        $username   = C('DB_USER');
        $password   = C('DB_PWD');

        // 建立连接
        $this->conn = mysql_connect($host,$username,$password);
        if (!$this->conn) {
            throw new Exception('连接失败');
        }

        if (!mysql_select_db($dbname)) {
            throw new Exception("数据库 $dbname 不存在");
        }
        $this->_query('set names \'utf-8\'');
    }


    public function test($num) {
        $start = time();

        while ($i++<$num) {

            $arr = array();
            $res = $this->_query('SELECT * FROM `topic` LIMIT 10');

            while ($row = mysql_fetch_assoc($res)) {
                $arr[] = $row;
            }

        }

        echo "用时:",(time()-$start),"秒<br>";

    }


    /**
     * 关闭数据库
     */
    public function closeConn() {
        if ($this->conn) {
            mysql_close($this->conn);
            //echo "关闭了连接";
        }
    }

    protected function _query($sql) {
        return mysql_query($sql,$this->conn);
    }
}
?>