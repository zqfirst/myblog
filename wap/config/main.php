<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-wap',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'wap\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-wap',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-wap', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the wap
            'name' => 'advanced-wap',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'route/<appId:wx\w+>' => 'wx/route',
            ],
        ],

    ],
    'defaultRoute' => 'index/index',
    'params' => $params,
    'modules' => [
	    'life' => [
		    'class' => 'wap\modules\life\Module'
	    ],
//	    'technology' => [
//		    'class' => 'frontend\modules\technology\Module'
//	    ],
	    'words' => [
		    'class' => 'wap\modules\words\Module'
	    ],
	    'wechat' => [
		    'class' => 'frontend\modules\wechat\Module'
	    ],
	    'blog' => [
		    'class' => 'wap\modules\blog\Module'
	    ],
    ],
];
