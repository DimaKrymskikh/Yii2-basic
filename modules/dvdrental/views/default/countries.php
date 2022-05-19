<?php
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\widgets\Pjax;

    $this->title = 'Страны';
    $this->params['breadcrumbs'][] = $this->title;
?>

<h1>Страны</h1>

<?php
    Pjax::begin();
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'country',
            [
                'label' => 'country',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(
                            'Города', 
                            ["/dvdrental/default/{$data->country_id}/cities"], 
                            [
                                'title' => "Города страны $data->country",
                            ]
                        );
                }
            ],
        ],
    ]);

    Pjax::end();
