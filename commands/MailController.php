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
            ->setFrom(isset(Yii::$app->params['emailFrom']) ? Yii::$app->params['emailFrom'] : 'a@b.com')
            ->setTo(isset(Yii::$app->params['emailTo']) ? Yii::$app->params['emailTo'] : 'c@d.com')
            ->setSubject('Проверка связи')
            ->send();
    }
}
