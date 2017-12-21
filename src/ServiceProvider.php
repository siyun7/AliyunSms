<?php
/**
 * Created by PhpStorm.
 * User: l57t7q
 * Date: 2017/12/21
 * Time: 15:15
 */

namespace L57t7q\AliyunSms;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot() {
        $this->publishes([
            __DIR__."/config.php" => config_path("aliyunsms.php"),
        ], "config");
    }

    public function register() {
        $this->mergeConfigFrom(__DIR__."/config.php", "aliyunsms");
        $this->app->bind(AliyunSms::class, function () {
            return new AliyunSms();
        });
    }

}