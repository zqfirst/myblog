<?php

namespace common\libs;

use Yii;

class ConfigHelper
{
    static public function getUserPhoneAesKey()
    {
        return Yii::$app->params['backendKey']['userAesKey'];
    }
}