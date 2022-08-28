<?php

/**
 * Загружаем из файла .env переменные среды, хранящие секретные параметры конфигурации
 */
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__));
$dotenv->load();

$db = require __DIR__ . '/test_db.php';
$modules = require __DIR__ . '/modules.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@dvdrental' => '@app/modules/dvdrental'
    ],
    'language' => 'en-US',
    'modules' => $modules,
    // Маршрут, который используется, когда url = '/'
    'defaultRoute' => 'default',
    'components' => [
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'urlManager' => [
            // Задаём человекопонятные URL
            'enablePrettyUrl' => true,
            // Отключаем имя входного скрипта
            'showScriptName' => false,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
    ],
    'params' => [],
];
