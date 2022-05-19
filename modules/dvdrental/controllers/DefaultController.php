<?php

namespace app\modules\dvdrental\controllers;

use app\models\Country;
use app\models\CountrySearch;
use app\models\City;

use Yii;
use yii\data\ActiveDataProvider;

class DefaultController extends \yii\base\Controller
{
    public function actionIndex(): string
    {
        return $this->render('dvdrental', []);
    }
    
    public function actionCountries(): string
    {
        $searchModel = new CountrySearch();
        
        return $this->render('countries', [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->get())
            ]);
    }
    
    public function actionCities(): string
    {
        return $this->render('cities', [
            'cities' => City::findAll(['country_id' => Yii::$app->request->get('countryId')])
        ]);
    }
}
