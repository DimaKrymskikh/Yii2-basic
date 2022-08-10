<?php
use yii\bootstrap4\Dropdown;
?>

<div class="dropdown" style="margin-bottom: 1rem">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Число фильмов на странице <b class="caret"></b></a>
    <?php
        echo Dropdown::widget([
            'items' => [
                ['label' => '10', 'url' => "$actionUrl?page=1&per-page=10"],
                ['label' => '20', 'url' => "$actionUrl?page=1&per-page=20"],
                ['label' => '50', 'url' => "$actionUrl?page=1&per-page=50"],
                ['label' => '100', 'url' => "$actionUrl?page=1&per-page=100"],
            ],
        ]);
    ?>
</div>
