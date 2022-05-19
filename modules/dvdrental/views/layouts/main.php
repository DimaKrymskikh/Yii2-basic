<?php

use app\modules\dvdrental\assets\AppAsset;

use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

/* @var $this yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <?php
        NavBar::begin([
            'brandLabel' => 'Home',
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
    
        echo Nav::widget([
            'options' => ['class' =>'navbar-nav'],
            'items' => [
                ['label' => 'dvdrental', 'url' => ['/dvdrental/default']],
                ['label' => 'Страны', 'url' => ['/dvdrental/default/countries']],
            ]
        ]);
    
        NavBar::end();
    ?>
</header>
 
<main>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</main>
    
<footer>Моя компания &copy; 2014</footer>
        
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>