<?php

namespace Bajieeeee;

class Tool
{
    /**
     * 记录日志
     * @param $content
     */
    public static function log($content)
    {
        if (is_array($content)) {
            file_put_contents('log.txt', date('Y-m-d H:i:s') . ' ' . print_r($content, true) . "\n", FILE_APPEND);
        } else {
            file_put_contents('log.txt', date('Y-m-d H:i:s') . ' ' . $content . "\n", FILE_APPEND);
        }
    }

    /**
     * 将八位二进制数转为字符串
     * @param string $bin 01001000 01100101 01101100 01101100 01101111 00100000 01010111 01101111 01110010 01101100 01100100
     * @return string
     */
    public static function bin2str($bin = '')
    {
        $str = str_replace(' ', '', $bin);
        $per_len = 8;
        $len = strlen($str) / $per_len;
        $res_str = '';
        for ($i = 0; $i < $len; $i++) {
            $tmp_str = substr($str, $i * $per_len, $per_len);
            $res_str .= chr(bindec(intval($tmp_str)));
        }
        return $res_str;
    }

    /**
     *  将字符串转为八位二进制数
     * @param string $str Hello World
     * @return string
     */
    public static function str2bin($str = '')
    {
        $tmp_arr = str_split($str);
        $res_str = '';
        foreach ($tmp_arr as $v) {
            $tmp_str = str_pad(decbin(ord($v)), 8, '0', STR_PAD_LEFT);
            $res_str .= $tmp_str . ' ';
        }
        $res_str = rtrim($res_str, ' ');
        return $res_str;
    }

    /**
     * curl请求
     * @param $url
     * @param $header
     * @param bool $post
     * @param array $data
     * @param false $convertArr 转换为数组
     * @return bool|mixed|string
     */
    public function curl_request($url, $header, $post = true, $data = [], $convertArr = false)
    {
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //超时设置，单位s
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        //伪装浏览器
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36');

        //设置请求头
        if ($header) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }

        //设置请求方式为post
        if ($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
        }
        //请求参数
        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        //设置获取的信息以文件流的形式返回，而不是直接输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //执行
        $res = curl_exec($curl);

        //curl异常问题
        if (curl_error($curl)) {
            return json_decode(curl_error($curl), true);
        }
        //关闭curl句柄
        curl_close($curl);

        $data = $convertArr ? json_decode($res, true) : $res;

        return $data;
    }
}