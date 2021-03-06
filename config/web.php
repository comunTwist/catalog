<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'main/index', // Вид по-умолчанию
    'modules' => [
        'languages' => [
            'class' => 'app\modules\languages\Module',
            //Языки используемые в приложении
            'languages' => [
                'Русский' => 'ru',
                'English' => 'en',
            ],
            'default_language' => 'ru', //основной язык (по-умолчанию)
            'show_default' => false, //true - показывать в URL основной язык, false - нет
        ],

        'yii2images' => [//подключаем модуль загрузки картинок
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'upload/store', //где будут хранится оригиналы картинок
            'imagesCachePath' => 'upload/cache', //где будут хранится обрезанные картинки
            'graphicsLibrary' => 'GD', //библиотека для работы с картинками
            'placeHolderPath' => '@webroot/upload/store/no-image.png', // картинка-заглушка
//            'imageCompressionQuality' => 100, // Сейчас не работает.
        ],
    ],
    'bootstrap' => [
        'log',
        'languages'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'forceTranslation' => true,
                    'basePath' => '@app/messages',
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DLxQjtMf3G_S4DjoKBMCpEv7Dfvm1yWD',
            'baseUrl' => '',
            'class' => 'app\components\Request'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
            'class' => 'app\components\UrlManager',
            'rules' => [
                'languages' => 'languages/default/index', //для модуля мультиязычности
                '/' => 'main/index',
                '<id:([0-9])+>/images/image-by-item-and-alias' => 'yii2images/images/image-by-item-and-alias', //правило для формирования корректного адреса до картинки
                'images/image-by-item-and-alias' => 'yii2images/images/image-by-item-and-alias', //правило для вывода заглушки
                '<action:\w+>' => 'main/<action>',
            ],
        ],

    ],
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
