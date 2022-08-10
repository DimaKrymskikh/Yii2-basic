<?php

namespace app\modules\dvdrental\controllers;

use Yii;
use yii\base\Controller;

use app\models\activeRecord\Film;
use app\modules\dvdrental\models\FilmSearch;

/**
 * Каталог
 */
class DefaultController extends Controller
{
    /**
     * Отрисовка страницы каталога
     * @return string
     */
    public function actionFilms(): string
    {
        $searchModel = new FilmSearch();
        $query = Film::find()->with(['language', 'infoUser'])->orderBy('title');
        
        return $this->render('films', [
            'searchModel' => $searchModel,
            'dataProvider' => $searchModel->search(Yii::$app->request->get(), $query),
        ]);
    }
}
