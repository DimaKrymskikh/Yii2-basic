<?php

namespace app\models\activeRecord;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель таблицы 'film'
 *
 * @property int $film_id
 * @property string $title
 * @property string|null $description
 * @property int|null $release_year
 * @property int $language_id
 * @property int $rental_duration
 * @property float $rental_rate
 * @property int|null $length
 * @property float $replacement_cost
 * @property string|null $rating
 * @property string $last_update
 * @property string|null $special_features
 * @property string $fulltext
 *
 * @property Actor[] $actors - актёры, снявшиеся в фильме
 * @property Language $language - язык фильма
 * @property InfoUsers[] $infoUsers - пользователи, владеющие хотя бы одним фильмом
 * @property InfoUsers $infoUser - аутентифицированный пользователь (может не владеть ни одним фильмом)
 */
class Film extends ActiveRecord
{
    /**
     * Таблица 'film'
     * @return string
     */
    public static function tableName(): string
    {
        return 'film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'language_id', 'fulltext'], 'required'],
            [['description', 'rating', 'special_features', 'fulltext'], 'string'],
            [['release_year', 'language_id', 'rental_duration', 'length'], 'default', 'value' => null],
            [['release_year', 'language_id', 'rental_duration', 'length'], 'integer'],
            [['rental_rate', 'replacement_cost'], 'number'],
            [['last_update'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'language_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'film_id' => 'Film ID',
            'title' => 'Название',
            'description' => 'Описание',
            'release_year' => 'Release Year',
            'language_id' => 'Language ID',
            'rental_duration' => 'Rental Duration',
            'rental_rate' => 'Rental Rate',
            'length' => 'Length',
            'replacement_cost' => 'Replacement Cost',
            'rating' => 'Rating',
            'last_update' => 'Last Update',
            'special_features' => 'Special Features',
            'fulltext' => 'Fulltext',
        ];
    }

    /**
     * Связь с таблицей 'actor' через таблицу 'film_actor'
     * @return ActiveQuery
     */
    public function getActors(): ActiveQuery
    {
        return $this->hasMany(Actor::className(), ['actor_id' => 'actor_id'])->viaTable('film_actor', ['film_id' => 'film_id']);
    }

    /**
     * Связь с таблицей 'language'
     * @return ActiveQuery
     */
    public function getLanguage(): ActiveQuery
    {
        return $this->hasOne(Language::className(), ['language_id' => 'language_id']);
    }
    
    /**
     * Связь с таблицей 'info.users' через таблицу 'info.film_users'
     * @return ActiveQuery
     */
    public function getInfoUsers(): ActiveQuery
    {
        return $this->hasMany(InfoUsers::className(), ['id' => 'user_id'])
            ->viaTable('info.film_users', ['film_id' => 'film_id']);
    }
    
    /**
     * Связь с таблицей 'info.users' через таблицу 'info.film_users' для одного пользователя.
     * При отрисовке каталога позволяет отображать иконки, показывающие, - фильм из списка пользователя или нет
     * @return ActiveQuery
     */
    public function getInfoUser(): ActiveQuery
    {
        return $this->hasOne(InfoUsers::className(), ['id' => 'user_id'])
            ->where(['id' => Yii::$app->user->identity ? Yii::$app->user->identity->id : 0])
            ->viaTable('info.film_users', ['film_id' => 'film_id']);
    }
}
