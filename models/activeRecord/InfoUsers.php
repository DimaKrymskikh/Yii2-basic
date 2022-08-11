<?php

namespace app\models\activeRecord;

use yii\db\ActiveRecord;

/**
 * Модель таблицы 'info.users'
 *
 * @property int $id
 * @property string $login - Логин
 * @property string $password - Пароль
 */
class InfoUsers extends ActiveRecord
{
    /**
     * Таблица 'info.users'
     * @return string
     */
    public static function tableName(): string
    {
        return 'info.users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string'],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }
}
