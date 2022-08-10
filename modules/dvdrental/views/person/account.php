<?php
use yii\helpers\Html;
use timurmelnikov\widgets\LoadingOverlayPjax;

use app\grid\GridView;

$this->title = 'Аккаунт';
$this->params['breadcrumbs'][] = $this->title;

$gridViewColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'title',
    'description',
    'language.name',
    [
        'label' => '',
        'format' => 'raw',
        'value' => function ($data) {
            return '<a href="/dvdrental/person/film-card?filmId=' . $data->film_id . '">'
                    . '<img src="/svg/eye.svg" alt="Просмотр карточки фильма" title="Просмотр карточки фильма">'
                    . '</a>';
        }
    ],
    [
        'label' => '',
        'format' => 'raw',
        'value' => function ($data) {
            return '<img src="/svg/trash.svg" alt="Удаление фильма" title="Удаление фильма" class="removal-film" data-film_id="' . $data->film_id . '">';
        },
    ]
];
?>

<h1>Аккаунт <?= Html::encode(Yii::$app->user->identity->login) ?></h1>
<?php

LoadingOverlayPjax::begin();

$actionUrl = '/dvdrental/person/account';
require __DIR__ . '/../boxes/dropdown/dropdownFilms.php';

echo GridView::widget([
    'id' => 'account-films-table',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridViewColumns,
]);

LoadingOverlayPjax::end();

require __DIR__ . '/../boxes/modal/accountDeleting.php';
require __DIR__ . '/../boxes/modal/filmDeleting.php';
