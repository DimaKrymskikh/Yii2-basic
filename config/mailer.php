<?php

/**
 * Настройки для отправки почты
 * Когда 'useFileTransport' = true, письмо сохраняется в файле в папке runtime\mail
 * Когда 'useFileTransport' = false, происходит реальная отправка почты
 */
return [
    'class' => 'yii\swiftmailer\Mailer',
//    'useFileTransport' => false,
    'useFileTransport' => true,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'encryption' => isset($params['encryption']) ? $params['encryption'] : '',
        'host' => isset($params['host']) ? $params['host'] : '',
        'port' => isset($params['port']) ? $params['port'] : '',
        'username' => isset($params['username']) ? $params['username'] : '',
        'password' => isset($params['password']) ? $params['password'] : '',
    ],
];
