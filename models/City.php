<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $city_id
 * @property string $city
 * @property int $country_id
 * @property string $last_update
 *
 * @property Address[] $addresses
 * @property Country $country
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'country_id'], 'required'],
            [['country_id'], 'default', 'value' => null],
            [['country_id'], 'integer'],
            [['last_update'], 'safe'],
            [['city'], 'string', 'max' => 50],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'country_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'city' => 'City',
            'country_id' => 'Country ID',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['city_id' => 'city_id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['country_id' => 'country_id']);
    }
}
