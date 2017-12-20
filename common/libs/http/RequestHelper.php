<?php

namespace common\libs\http;

use Yii;
use yii\helpers\HtmlPurifier;

/**
 * Description of class RequestHelper
 * 
 * @version   1.0
 */
class RequestHelper
{
    /**
     * 获取 GET 请求参数参数，int 类型
     * 
     * @param string $name
     * @return int
     */
    public static function getInt($name)
    {
        return intval(static::get($name));
    }

    /**
     * 获取 GET 请求参数，float 类型参数值
     * 
     * @param string $name
     * @return float
     */
    public static function getFloat($name)
    {
        return floatval(static::get($name));
    }

    /**
     * 获取 GET 请求参数，double 类型参数值
     * 
     * @param string $name
     * @return double
     */
    public static function getDouble($name)
    {
        return doubleval(static::get($name));
    }

    /**
     * 获取 GET 请求参数，bool 类型参数值
     * 
     * @param string $name
     * @return bool true / false
     */
    public static function getBool($name)
    {
        $result = strtolower(strval(static::get($name)));
        if ($result === '0' || $result === 'false') {
            return false;
        } else if ($result === '1' || $result == 'true') {
            return true;
        } else {
            throw new \Exception(__METHOD__ . ' param $name\'s value is not bool type');
        }
    }

    /**
     * 获取 GET 请求参数，string 类型参数值
     * 
     * @param string $name
     * @param int $length
     * @return string
     */
    public static function getString($name, $length)
    {
        $result = strval(static::get($name));
        return mb_substr($result, 0, intval($length), 'utf8');
    }

    /**
     * 获取 POST 请求参数，int 类型参数值
     * 
     * @param string $name
     * @return int
     */
    public static function postInt($name)
    {
        return intval(static::post($name));
    }

    /**
     * 获取 POST 请求参数，float 类型参数值
     * 
     * @param string $name
     * @return float
     */
    public static function postFloat($name)
    {
        return floatval(static::post($name));
    }

    /**
     * 获取 POST 请求参数，double 类型参数值
     * 
     * @param string $name
     * @return double
     */
    public static function postDouble($name)
    {
        return doubleval(static::post($name));
    }

    /**
     * 获取 POST 请求参数，bool 类型参数值
     * 
     * @param string $name
     * @return bool true / false
     */
    public static function postBool($name)
    {
        $result = strtolower(strval(static::post($name)));
        if ($result === '0' || $result === 'false') {
            return 0;
        } else if ($result === '1' || $result == 'true') {
            return 1;
        } else {
            throw new \Exception(__METHOD__ . ' param $name\'s value is not bool type');
        }
    }

    /**
     * 获取 POST 请求参数，string 类型参数值
     * 
     * @param string $name
     * @param int $length
     * @return string
     */
    public static function postString($name, $length)
    {
        $result = strval(static::post($name));
        return mb_substr($result, 0, intval($length), 'utf8');
    }

    /**
     * Returns POST parameter with a given name. If name isn't specified, returns an array of all POST parameters.
     *
     * @param string $name the parameter name
     * @param mixed $defaultValue the default parameter value if the parameter does not exist.
     * @return array|mixed
     */
    public static function post($name = null, $defaultValue = null)
    {
        if ($name === null) {
            $data = Yii::$app->request->post();
        } else {
            $data = Yii::$app->request->post($name, $defaultValue);
        }
        return static::htmlPurifier($data);
    }

    /**
     * Returns GET parameter with a given name. If name isn't specified, returns an array of all GET parameters.
     *
     * @param string $name the parameter name
     * @param mixed $defaultValue the default parameter value if the parameter does not exist.
     * @return array|mixed
     */
    public static function get($name = null, $defaultValue = null)
    {
        if ($name === null) {
            $data = Yii::$app->request->get();
        } else {
            $data = Yii::$app->request->get($name, $defaultValue);
        }
        return static::htmlPurifier($data);
    }

    private static function htmlPurifier($data)
    {
        if (is_string($data)) {
//          $data = \yii\helpers\HtmlPurifier::process($data);  
            $data = HtmlPurifier::process($data);
            $data = trim(addslashes($data)); //防止sql注入
            return $data;
        } elseif (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = static::htmlPurifier($value);
            }
            return $data;
        } else {
            return $data;
        }
    }
}
