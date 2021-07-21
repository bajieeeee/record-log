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
        }else{
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
        for ($i = 0; $i < $len; $i++){
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
}