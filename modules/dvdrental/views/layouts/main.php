<?php
/**
 * Добавляем ресурсы, которые применяются только в модуле dvdrental
 */
$this->beginContent('@app/views/layouts/main.php');

use app\modules\dvdrental\assets\DvdrentalAsset;

DvdrentalAsset::register($this);

echo $content;

$this->endContent();
