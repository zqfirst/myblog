<?php

namespace common\libs\helpers;

use Yii;

class ConfigHelper {

	/**
	 * 获取用户手机号加密的key
	 */
	public static function getUserPhoneAesKey()
	{
		return Yii::$app->params['backendKey']['userAesKey'];
	}

	/**
	 * 返回PC域名
	 *
	 * @return string
	 */
	public static function  getPcUrl(){
		return rtrim(Yii::$app->params['myblog_host']['pc'], '/'). '/';
	}

	/**
	 * 返回wap端地址
	 *
	 * @return string
	 */
	public static function getWapUrl(){
		return rtrim(Yii::$app->params['myblog_host']['wap'], '/'). '/';
	}
}