<?php
use timurmelnikov\widgets\LoadingOverlayPjax;

use app\grid\GridView;

$this->title = 'Фильмы';
$this->params['breadcrumbs'][] = $this->title;

$gridViewColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'title',
    'description',
    'language.name',
];

if (!Yii::$app->user->isGuest) {
    $gridViewColumns[] = [
        'label' => '',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->infoUser ? '<img src="/svg/check-circle.svg" alt="Наличие фильма">'
                    : '<img class="adding-film" src="/svg/plus-circle.svg" alt="Добавление фильма" data-film_id="' . $data->film_id . '">';
        }
    ];
}
?>

<h1>Фильмы</h1>

<?php
LoadingOverlayPjax::begin();

$actionUrl = '/dvdrental/default/films';
require __DIR__ . '/../boxes/dropdown/dropdownFilms.php';

echo GridView::widget([
    'id' => 'films-table',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridViewColumns,
]);

LoadingOverlayPjax::end();
