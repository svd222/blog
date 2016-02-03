<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','bootstrap'],
    'layout' => 'main-layout',
    'components' => [
        'bootstrap' => [
            'class' => 'app\components\Bootstrap'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'purZuqxwM02hhm2KtCCXYfV1LqwAdDvX',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => '\app\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',//'yii\rbac\DbManager' || 'dektrium\rbac\components\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'urlManager' => [
	    'enablePrettyUrl' => true,
	    'showScriptName'  => false,
	    //'enableStrictParsing' => true,
	    'rules' => [
                [
                    'pattern' => '',
                    'route' => 'site/index'
                ],
//                [
//                    'pattern' => '/account',
//                    'route' => '/user-account/index'
//                ],
//                [
//                    'pattern' => '/account/<action>',
//                    'route' => '/user-account/<action>'
//                ],
//                [
//                    'pattern' => '/account/<action>/<id:\d+>',
//                    'route' => '/user-account/<action>'
//                ],
//                [
//                    'pattern' => '/signup',
//                    'route' => 'user/create'
//                ],
                
		[
		    'pattern' => '<controller>/<action>/<id:\d+>',
		    'route' => '<controller>/<action>',		
		],
		
		[
		    'pattern' => '<controller>/<action>',
		    'route' => '<controller>/<action>',		
		],
		[
		    'pattern' => '<module>/<controller>/<action>/<id:\d+>',
		    'route' => '<module>/<controller>/<action>',		
		],
		[
		    'pattern' => '<module>/<controller>/<action>',
		    'route' => '<module>/<controller>/<action>',		
		],
                
	    ],
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
        'db' => require(__DIR__ . '/db.php'),
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/lamar',
                'baseUrl' => '@web/themes/lamar',
                'pathMap' => [
                    '@app/views' => '@app/themes/lamar/views',
                ],
            ]
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'mailer' => [
                'sender' => 'set_sender@here.com'
            ],
            'modelMap' => [
                'User' => 'app\models\User',
            ],           
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],                
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
