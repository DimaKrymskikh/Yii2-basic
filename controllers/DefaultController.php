<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Главная страница и страница ошибок
 */
class DefaultController extends Controller
{
    public function actions(): array
    {
        return [
            // В этом котроллере задаём ErrorAction (отрисовка страницы ошибок)
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Главная страница
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
