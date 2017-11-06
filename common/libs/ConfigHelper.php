<?php

namespace common\libs;

use Yii;

class ConfigHelper
{
	/**
	 * 获取用户手机号加密的key
	 */
    static public function getUserPhoneAesKey()
    {
        return Yii::$app->params['backendKey']['userAesKey'];
    }
}