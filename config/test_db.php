<?php
/**
 * Настройки тестовой базы данных
 */
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=5433;dbname=testdvdrental',
    'username' => 'postgres',
    'password' => '1234',
    'charset' => 'utf8',
];
