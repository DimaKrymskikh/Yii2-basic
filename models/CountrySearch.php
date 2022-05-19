<?php

namespace app\models;

use yii\data\ActiveDataProvider;

use yii\base\Model;

class CountrySearch extends Country
{
    public function rules(): array
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
                [['country'], 'string', 'max' => 50],
            ];
    }
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    public function search($params) 
    {
        $query = Country::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['ilike', 'country', $this->country]);
        
        return $dataProvider;
    }
}
