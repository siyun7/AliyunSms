<?php
/**
 * Created by PhpStorm.
 * User: l57t7q
 * Date: 2017/12/21
 * Time: 15:23
 */
namespace L57t7q\AliyunSms;

use L57t7q\AliyunSmsSdk\Config;
use L57t7q\AliyunSmsSdk\DefaultAcsClient;
use L57t7q\AliyunSmsSdk\Profile\DefaultProfile;
use L57t7q\Api\Sms\Request\V20170525\SendSmsRequest;

// 加载区域结点配置
Config::load();

class AliyunSms
{

    static $acsClient = null;

    public function sendSms($to, $templateCode, $data, Array $config = null, $outId = null) {

        if ($config) {
            $signName = $config['sign_name'];
        } else {
            $signName = config('aliyunsms.sign_name');
        }

        $sendRequest = new SendSmsRequest();
        $sendRequest->setPhoneNumbers($to);
        $sendRequest->setSignName($signName);
        $sendRequest->setTemplateCode($templateCode);
        if ($data) $sendRequest->setTemplateParam(json_encode($data), JSON_UNESCAPED_UNICODE);
        if ($outId) $sendRequest->setOutId($outId);
        $acsResponse = static::getAcsClient($config)->getAcsResponse($sendRequest);
        return $acsResponse;

    }

    public static function getAcsClient($config) {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Dysmsapi";
        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";
        // 暂时不支持多Region
        $region = "cn-hangzhou";
        // 服务结点
        $endPointName = "cn-hangzhou";

        if ($config) {
            $accessKeyId = $config['access_key'];
            $accessKeySecret = $config['access_secret'];
        } else {
            $accessKeyId = config('aliyunsms.access_key');
            $accessKeySecret = config('aliyunsms.access_secret');
        }

        if (static::$acsClient == null) {

            //初始化acsClient,暂不支持region化
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

            // 增加服务结点
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

            // 初始化AcsClient用于发起请求
            static::$acsClient = new DefaultAcsClient($profile);
        }
        return static::$acsClient;
    }
}