<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'errorAction' => 'error/error',
        ],

//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'suffix' =>'.html',
//        ],
    ],
    'defaultRoute' => 'index/index',
    'params' => $params,
    'modules' => [
	    'life' => [
		    'class' => 'frontend\modules\life\Module'
	    ],
	    'technology' => [
		    'class' => 'frontend\modules\technology\Module'
	    ],
	    'words' => [
		    'class' => 'frontend\modules\words\Module'
	    ],
	    'record' => [
		    'class' => 'frontend\modules\record\Module'
	    ],
	    'blog' => [
		    'class' => 'frontend\modules\blog\Module'
	    ],
        'test' => [
            'class' => 'frontend\modules\test\Module'
        ],
        'tool' => [
            'class' => 'frontend\modules\tool\Module'
        ]
    ],
];
