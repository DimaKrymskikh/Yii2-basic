<?php

namespace app\models\activeRecord;

use yii\db\ActiveRecord;

/**
 * Модель таблицы 'info.film_users'
 *
 * @property int $user_id - id пользователя
 * @property int $film_id - id фильма
 */
class InfoFilmUsers extends ActiveRecord
{
    /**
     * Таблица 'info.film_users'
     * @return string
     */
    public static function tableName(): string
    {
        return 'info.film_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'film_id'], 'required'],
            [['user_id', 'film_id'], 'default', 'value' => null],
            [['user_id', 'film_id'], 'integer'],
            [['user_id', 'film_id'], 'unique', 'targetAttribute' => ['user_id', 'film_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => InfoUsers::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => Film::className(), 'targetAttribute' => ['film_id' => 'film_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'user_id' => 'User ID',
            'film_id' => 'Film ID',
        ];
    }
}
