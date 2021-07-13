<?php

namespace chunyuan;

class RecordLog
{
    public function __construct()
    {

    }

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
}