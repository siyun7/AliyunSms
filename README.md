# 介绍
阿里短信，自用

* 安装
` composer require l57t7q/aliyun-sms dev-master `

## 基于laravel框架的使用方法

* 加载
在config/app的providers中添加
` L57t7q\AliyunSms\ServiceProvider::class `

同时，可以选择性添加aliases

控制台运行:
` php artisan vendor:publish `

根据新增的` aliyunsms.php ` 文件，在.env文件中添加环境变量：
``` 
ALIYUN_SMS_AK=your access key
ALIYUN_SMS_AS=your secret key
ALIYUN_SMS_SIGN_NAME=sign name
```

* 使用
```
$AliyunSms = new AliyunSms();
$response = $AliyunSms->sendSms('phone number', 'SMS_code', ['name'=> 'value in your template']);
//dump($response);
```

## 非laravel框架的使用方法

* 加载方式通过composer，不变
* 使用样例代码如下：

```
$config = [
        'access_key' => 'your access key',
        'access_secret' => 'your access secret',
        'sign_name' => 'your sign name',
    ];

    $aliSms = new L57t7q\AliyunSms\AliyunSms();
    $response = $sms->sendSms('phone number', 'tempplate code', ['name'=> 'value in your template'], $config);
```