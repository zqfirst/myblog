<?php

namespace common\libs\http;

use GuzzleHttp\Client;

class Http {

	private static $client = null;
	public $responseHeader;
	public $responseStatus;

	public function __construct()
	{
		if( is_null( self::$client ) ) {
			self::$client = new Client();
		}
	}

	public function get( $url, $config = [], $header = [] )
	{
		$options              = array_merge( $this->getDefaultConfig(), $config, [ "headers" => $header ] );
		$response             = self::$client->get( $url, $options );
		$this->responseHeader = $response->getHeaders();
		$this->responseStatus = $response->getStatusCode();
		$responseContent      = $response->getBody()->getContents();
	}

	public function post( $url, $data, $config = [], $header = [] )
	{
	}

	public function getAsync()
	{
	}

	public function postAsync()
	{
	}

	private function sendRequest()
	{
	}

	private function getDefaultConfig()
	{
		return [
			'http_errors' => false
		];
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
}