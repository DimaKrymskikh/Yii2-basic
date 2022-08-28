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
        'encryption' => getenv('MAIL_ENCRYPTION'),
        'host' => getenv('MAIL_HOST'),
        'port' => getenv('MAIL_PORT'),
        'username' => getenv('MAIL_USERNAME'),
        'password' => getenv('MAIL_PASSWORD'),
    ],
];
