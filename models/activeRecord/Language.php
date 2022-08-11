<?php

namespace app\models\activeRecord;

use yii\db\ActiveRecord;

/**
 * Модель таблицы 'language'
 *
 * @property int $language_id
 * @property string $name
 * @property string $last_update
 *
 * @property Film[] $films
 */
class Language extends ActiveRecord
{
    /**
     * Таблица 'language'
     * @return string
     */
    public static function tableName(): string
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['last_update'], 'safe'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'language_id' => 'Language ID',
            'name' => 'Язык',
            'last_update' => 'Last Update',
        ];
    }
}
