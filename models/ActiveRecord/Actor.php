<?php

namespace app\models\activeRecord;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель таблицы 'actor'
 *
 * @property int $actor_id
 * @property string $first_name
 * @property string $last_name
 * @property string $last_update
 *
 * @property Film[] $films
 */
class Actor extends ActiveRecord
{
    /**
     * Таблица 'actor'
     * @return string
     */
    public static function tableName(): string
    {
        return 'actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['last_update'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'actor_id' => 'Actor ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Связь с таблицей 'film' через таблицу 'film_actor'
     * @return ActiveQuery
     */
    public function getFilms(): ActiveQuery
    {
        return $this->hasMany(Film::className(), ['film_id' => 'film_id'])->viaTable('film_actor', ['actor_id' => 'actor_id']);
    }
}
