<?php
/**
 * Настройки тестовой базы данных
 */
return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DB_TEST_DSN'),
    'username' => getenv('DB_TEST_USERNAME'),
    'password' => getenv('DB_TEST_PASSWORD'),
    'charset' => 'utf8',
];
