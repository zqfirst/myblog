<?php

namespace wap\controllers;

use common\libs\helpers\ConfigHelper;
use EasyWeChat\Foundation\Application;
use yii\web\NotFoundHttpException;

class WxController extends BaseController
{
    public $enableCsrfValidation = false;

    public function actionRoute($appId)
    {
        $appConfig = ConfigHelper::getWechatConfig();
        $options = [
            'debug' => true,
            'app_id' => $appConfig['app_id'],
            'secret' => $appConfig['app_secret'],
            'token' => $appConfig['token'],
            'aes_key' => $appConfig['aes_key'],
            'log' => [
                'level' => 'error',
                'file' => \Yii::getAlias('@runtime') . '/logs/wechat.log',
            ],
        ];

        $app = new Application($options);
        $app->server->setMessageHandler(function ($message) use ($app, $appConfig) {
            $fromUser = $app->user->get($message->FromUserName);
            return "{$fromUser->nickname} 您好！欢迎关注 overtrue!";
        });
        $app->server->serve()->send();
    }
}