<?php
/**
 * Created by PhpStorm.
 * User: l57t7q
 * Date: 2017/12/21
 * Time: 15:38
 */

namespace L57t7q\AliyunSmsSdk;


class Autoload
{

    public static function config() {
        if (!defined("ALIYUN_SMS_PATH")) {
            define("ALIYUN_SMS_PATH", dirname(__FILE__) . '/');
        }
        include (ALIYUN_SMS_PATH."Config.php");
    }
}