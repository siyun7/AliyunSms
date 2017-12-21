<?php
/**
 * Created by PhpStorm.
 * User: l57t7q
 * Date: 2017/12/21
 * Time: 15:23
 */
namespace L57t7q\AliyunSms;

use L57t7q\AliyunSmsSdk\Autoload;
use L57t7q\AliyunSmsSdk\DefaultAcsClient;
use L57t7q\AliyunSmsSdk\Profile\DefaultProfile;
use L57t7q\Api\Sms\Request\V20170525\SendSmsRequest;

class AliyunSms
{
    public function sendSms($to, $templateCode, $data, Array $config = null, $outId = null) {

        if ($config) {
            $accessKeyId = $config['access_key'];
            $accessKeySecret = $config['access_secret'];
            $signName = $config['sign_name'];
        } else {
            $accessKeyId = config('aliyunsms.access_key');
            $accessKeySecret = config('aliyunsms.access_secret');
            $signName = config('aliyunsms.sign_name');
        }

        //短信API产品名
        $product = "Dysmsapi";
        //短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region
        $region = "cn-hangzhou";
        // 服务结点
        $endPointName = "cn-hangzhou";

        Autoload::config();

        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);
        $acsClient = new DefaultAcsClient($profile);

        $requset = new SendSmsRequest();
        $requset->setPhoneNumbers($to);
        $requset->setSignName($signName);
        $requset->setTemplateCode($templateCode);
        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode($data), JSON_UNESCAPED_UNICODE);
        if ($outId) $request->setOutId($outId);

        return $acsClient->getAcsResponse($request);

    }
}