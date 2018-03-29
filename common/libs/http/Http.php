<?php

namespace common\libs\http;

use GuzzleHttp\Client;

class Http
{
    public $responseHeader;
    public $responseStatus;
    private static $client = null;

    /**
     * 初始化配置方法
     *
     * Http constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (is_null(self::$client)) {
            self::$client = new Client(array_merge($this->getDefaultConfig(), $config));
        }
    }

    /**
     * 同步get请求
     * @param $url
     * @param array $config
     * @param array $header
     *
     * @return string
     */
    public function get($url, $config = [], $header = [])
    {
        return $this->sendRequest('get', $url, [], $header, $config, false);
    }

    /**
     * 同步post请求
     *
     * @param $url
     * @param $data
     * @param array $config
     * @param array $header
     * @return string
     */
    public function post($url, $data, $config = [], $header = [])
    {
        return $this->sendRequest('post', $url, $data, $header, $config, false);
    }

    /**
     * 异步get请求
     *
     * @param $url
     * @param array $config
     * @param array $header
     * @return string
     */
    public function getAsync($url, $config = [], $header = [])
    {
        return $this->sendRequest('get', $url, [], $header, $config, true);
    }

    /**
     * 异步post请求
     *
     * @param $url
     * @param $data
     * @param array $config
     * @param array $header
     * @return string
     */
    public function postAsync($url, $data, $config = [], $header = [])
    {
        return $this->sendRequest('post', $url, $data, $header, $config, true);
    }

    static public function check_remote_file_exists( $url )
    {
        $curl = curl_init( $url );
        // 不取回数据
        curl_setopt( $curl, CURLOPT_NOBODY, true );
        curl_setopt( $curl, CURLOPT_TIMEOUT, 2 );
        // 发送请求
        $result = curl_exec( $curl );
        $found  = $result !== false && curl_getinfo( $curl, CURLINFO_HTTP_CODE ) !== 404 ? true : false;
        curl_close( $curl );

        return $found;
    }

    /**
     * 发送同步或者异步请求
     *
     * @param $method
     * @param $url
     * @param $data
     * @param $header
     * @param $config
     * @param $async
     * @return string
     */
    private function sendRequest($method, $url, $data, $header, $config, $async)
    {
        $options = array_merge(['headers' => $header, 'form_params' => $data], $config);
        $response = $async ?
            self::$client->requestAsync($method, $url, $options) :
            self::$client->request($method, $url, $options);
        $this->responseHeader = $response->getHeaders();
        $this->responseStatus = $response->getStatusCode();

        return $response->getBody()->getContents();
    }

    /**
     * 获取默认的配置信息
     *
     * @return array
     */
    private function getDefaultConfig()
    {
        return [
            'http_errors' => false,
            'timeout'     => 10,
        ];
    }
}