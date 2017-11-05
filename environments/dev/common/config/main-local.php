<?php
return [
    'components' => [
	    'db' => [
		    'class' => 'yii\db\Connection',
		    'dsn' => 'mysql:host=www.zhangqq.com;dbname=myblog',
		    'username' => 'zhangqiang',
		    'password' => '123',
		    'charset' => 'utf8',
	    ],
	    'mailer' => [
		    'class' => 'yii\swiftmailer\Mailer',
		    'viewPath' => '@common/mail',
	    ],
    ],
];
