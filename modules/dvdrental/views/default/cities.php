<?php
    $this->title = 'Города';
    $this->params['breadcrumbs'][] = ['label' => 'Страны', 'url' => '/dvdrental/default/countries'];
    $this->params['breadcrumbs'][] = $this->title;
?>

<h1>Города</h1>

<ul>
<?php
    foreach ($cities as $city) {
?>
    <li><?= $city->city ?></li>
<?php
    }
?>
</ul>
