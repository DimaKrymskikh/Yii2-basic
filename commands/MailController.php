<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * Тестовая отправка письма
 */
class MailController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->mailer->compose('trial')
            ->setFrom(Yii::$app->params['emailFrom'])
            ->setTo(Yii::$app->params['emailTo'])
            ->setSubject('Проверка связи')
            ->send();
    }
}
