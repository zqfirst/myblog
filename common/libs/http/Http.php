<?php

namespace common\libs\http;

use GuzzleHttp\Client;

class Http {
	private static $client = null;
	public $responseHeader;
	public $responseStatus;

	public function __construct() {
		if ( is_null( self::$client ) ) {
			self::$client = new Client();
		}
	}

	public function get( $url, $config = [], $header = [] ) {

		$options  = array_merge( $this->getDefaultConfig(), $config, [ "headers" => $header ] );
		$response = self::$client->get( $url, $options );

		$this->responseHeader = $response->getHeaders();
		$this->responseStatus = $response->getStatusCode();

		$responseContent = $response->getBody()->getContents();
	}

	public function post( $url, $data, $config = [], $header = [] ) {

	}

	public function getAsync() {

	}

	public function postAsync() {

	}

	private function sendRequest() {

	}

	private function getDefaultConfig() {
		return [
			'http_errors' => false
		];
	}
}