<?php
$params = [
	'vendorPath'     => dirname( dirname( __DIR__ ) ) . '/vendor',
	'language'       => 'zh-CN',
	'sourceLanguage' => 'zh-CN',
	'components'     => [
		'cache'        => [
			'class' => 'yii\caching\FileCache',
		],
		'urlManager'   => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
		],
	],
];

if( class_exists( 'alexandernst\devicedetect\DeviceDetect' ) ) {
	$params['components'] = array_merge( $params['components'], [
		'devicedetect' => [
			'class' => 'alexandernst\devicedetect\DeviceDetect'
		]
	] );
}

return $params;
