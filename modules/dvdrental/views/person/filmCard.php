<?php
$this->title = 'Карточка фильма';
$this->params['breadcrumbs'][] = [
    'label' => 'Аккаунт',
    'url' => '/dvdrental/person/account'
];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= $film->title ?></h2>

<div class="row">
    <div class="col">
        <h4>Основная информация</h4>
    </div>
    <div class="col">
        <h4>Описание</h4>
    </div>
    <div class="col">
        <h4>Актёры</h4>
    </div>
</div>

<div class="row">
    <div class="col">
        <div>Фильм вышел в <?= $film->release_year ?> году</div>
        <div>Язык фильма: <?= $film->language->name ?></div>
    </div>
    <div class="col">
        <div><?= $film->description ?></div>
    </div>
    <div class="col">
        <?php 
            foreach ($film->actors as $actor) {
        ?>
                <div><?= $actor->first_name . ' ' . $actor->last_name ?></div>
        <?php 
            }
        ?>
    </div>
</div>
