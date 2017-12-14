<?php

namespace wap\controllers;

use common\libs\helpers\ConfigHelper;
use EasyWeChat\Foundation\Application;
use yii\web\NotFoundHttpException;

class WxController extends BaseController
{
    public function actionRoute($appId)
    {
        $appConfig = ConfigHelper::getWechatConfig();
        $options = [
            'debug' => true,
            'app_id' => $appConfig['app_id'],
            'secret' => $appConfig['secret'],
            'token' => $appConfig['token'],
            'aes_key' => $appConfig['aes_key'],
            'log' => [
                'level' => 'error',
                'file' => \Yii::getAlias('@runtime') . '/logs/wechat.log',
            ],
        ];
        $app = new Application($options);
        $app->server->setMessageHandler(function ($message) use ($app, $appConfig) {
//            try {
//
//            } catch (\Exception $e) {
//                return $e->getMessage();
//            }
        });
        $app->server->serve()->send();
    }
}