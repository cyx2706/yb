<?php
class https {
    // 枚举
    const GET           = 1;
    const POST          = 2;

    // 变量
    private $url        = '';
    private $data       = '';
    private $pattern    = 0;
    private $responseTxt = '';
    private $info       = array();

    /**
     * https constructor.
     * @param $url string
     * @param $data array
     * @param $pattern int https::GET|https::POST
     */
    public function __construct($url,$data,$pattern) {
        $this->data     = $data ? http_build_query($data) : '';
        $this->pattern  = $pattern;
        $this->url      = $url;

        // 如果是get请求就把参数加到url上
        if ($this->pattern == https::GET && strlen($this->data) > 0) {
            $this->url .= '?'. $this->data;
        }
        // curl初始化
        $ch = curl_init($this->url);
        // 返回header
        curl_setopt($ch, CURLOPT_HEADER,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
        // 隐藏抓取结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 如果是post请求,设置post字段
        if ($pattern == https::POST) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
        }
        $this->responseTxt = curl_exec($ch);
        $this->info = curl_getinfo($ch);
        curl_close($ch);
    }

    /**
     * 获取抓取的网页内容
     * @return string
     */
    public function getResponseTxt() {
        return $this->responseTxt;
    }

    /**
     * 获取返回的json对象
     * @param bool $mod
     * @return mixed
     */
    public function getResponseJson($mod = true) {
        return json_decode($this->responseTxt,$mod);
    }

    /**
     * 返回header信息数组，详细参考curl_getinfo()函数
     * @return array
     */
    public function getInfo() {
        return $this->info;
    }
}

?>