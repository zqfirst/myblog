<?php

return [
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
        'idcard' => [
            'class' => 'Verify\idcard\IdcardVerify'
        ],
        'devicedetect' => [
            'class' => 'alexandernst\devicedetect\DeviceDetect'
        ]
	],
];

