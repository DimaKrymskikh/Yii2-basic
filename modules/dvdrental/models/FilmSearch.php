<?php

namespace app\modules\dvdrental\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\models\activeRecord\Film;

/**
 * Модель поиска фильмов
 */
class FilmSearch extends Film
{
    /**
     * @return array - правила проверки
     */
    public function rules(): array
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }
    
    /**
     * @return array - список сценариев и соответствующих активных атрибутов
     */
    public function scenarios(): array
    {
        // возвращает все сценарии, найденные в объявлении метода rules()
        return Model::scenarios();
    }
    
    /**
     * Реализует логику фильтрации фильмов
     * @param type $params - параметры внешнего запроса
     * @param type $query - строка запроса в базу
     * @return ActiveDataProvider
     */
    public function search($params, $query): ActiveDataProvider
    {
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => Yii::$app->request->get('per-page') ?: 20,
                ],
            ]);
        
        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere(['ilike', 'title', $this->title]);
        $query->andFilterWhere(['ilike', 'description', $this->description]);
        
        return $dataProvider;
    }
}
