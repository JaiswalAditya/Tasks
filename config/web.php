<?php

use yii\web\Request;
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    // 'defaultRoute' => 'site/login',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'VkeeMKy9TViIagJZ1jHm89vOQXyIpCVl',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
//            'pdf' => [
//                'class' => Pdf::classname(),
//                'format' => Pdf::FORMAT_A4,
//                'orientation' => Pdf::ORIENT_PORTRAIT,
//                'destination' => Pdf::DEST_BROWSER,
//                // refer settings section for all configuration options
//            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'enableSession' => true,
            'authTimeout' => 3600, //100 minutes
            'loginUrl' => $baseUrl . '/site/login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'enableStrictParsing' => true,
            'baseUrl' => $baseUrl,
            'rules' => [
            ],
        ],
    ],
//    'components' => [
//        // setup Krajee Pdf component
//
//    ],
    'params' => $params,
    'modules' => [
        'api' => [
//            'basePath' => '@app/modules/api',
            'class' => 'app\modules\api\Module',
        ],
        'gridview' => ['class' => 'kartik\grid\Module']
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
