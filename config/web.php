<?php

use yii\web\Request;

defined('SITE_LANG') or define ('SITE_LANG', 'ru');

$db = require __DIR__ . '/db.php';
$params = require __DIR__ . '/params.php';
$rules = require __DIR__ . '/rules.php';

if (file_exists(__DIR__ . './func.php')) {
    require_once (__DIR__ . './func.php');
}

$config = [
    'id' => 'astashenkov',
    'name' => 'astashenkov.ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'baseUrl' => str_replace('/web', '', (new Request)->getBaseUrl()),
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'vhjrlJUHTv-TADAZNxqMlkIMtQ60ufDb',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'frontend/site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
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
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => $rules,
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-advanced-app'
                ],
            ],
        ],
    ],
    // 'controllerMap' => [
    //     'elfinder' => [
    //         'class' => 'mihaildev\elfinder\PathController',
    //         'access' => ['@'],
    //         'root' => [
    //             'path' => 'files',
    //             'name' => 'Files'
    //         ],
    //         'watermark' => [
    //         'source'             => __DIR__.'/logo.png',              // Path to Water mark image
    //             'marginRight'    => 5,                                // Margin right pixel
    //             'marginBottom'   => 5,                                // Margin bottom pixel
    //             'quality'        => 95,                               // JPEG image save quality
    //             'transparency'   => 70,                               // Water mark image transparency ( other than PNG )
    //             'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
    //             'targetMinPixel' => 200                               // Target image minimum pixel size
    //         ],
    //         'managerOptions' => [
    //             'handlers' => [
    //                 'select' => 'function(event, elfinderInstance) {
    //                                 console.log(event.data);
    //                                 console.log(event.data.selected);
    //                             }',
    //                 'open' => 'function(event, elfinderInstance) {...}',
    //             ],
    //         ],
    //     ]
    // ],
    'params' => $params,
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
