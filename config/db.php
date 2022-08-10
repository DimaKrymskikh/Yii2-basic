<?php

/**
 * Настройки базы данных
 */
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=5433;dbname=dvdrental',
    'username' => 'postgres',
    'password' => '1234',
    'charset' => 'utf8',
];
