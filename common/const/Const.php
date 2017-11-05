<?php

/**
 * url map数组
 * Class Url
 */
class Url
{
    static private $urlArray = [
        'backendIndex' => '/system/index/index',
    ];

    static public function getUrl($key = '')
    {
        return empty($key) ? self::$urlArray : self::$urlArray[$key];
    }
}

class ResponseCode
{
	const SUCCESS_CODE = '200';
	const FAIL_CODE = '101';
}