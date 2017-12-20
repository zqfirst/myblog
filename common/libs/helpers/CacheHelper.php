<?php

namespace common\libs\helpers;

class CacheHelper {

	private static $cache;

	const CACHE_PC_ROUTE_ARR = 'pc_route_arr';
	const CACHE_PC_EXCEPT_ROUTE_ARR = 'pc_except_route_arr';
	const CACHE_WAP_ROUTE_ARR = 'wap_route_arr';
	const CACHE_WAP_EXCEPT_ROUTE_ARR = 'wap_except_route_arr';

	/**
	 * @param $key
	 *
	 * @return mixed
	 */
	public static function get( $key )
	{
		return self::cache()->get( $key );
	}

	/**
	 * @param $key
	 * @param $value
	 * @param string $expire
	 *
	 * @return bool
	 */
	public static function set( $key, $value, $expire = '' )
	{
		return self::cache()->set( $key, $value, $expire );
	}

	/**
	 * @return \yii\caching\CacheInterface
	 */
	private static function cache()
	{
		self::$cache = self::$cache ?: \Yii::$app->cache;

		return self::$cache;
	}
}