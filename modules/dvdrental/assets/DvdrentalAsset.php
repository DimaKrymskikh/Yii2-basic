<?php

namespace app\modules\dvdrental\assets;

use yii\web\AssetBundle;

/**
 * Ресурсы модуля dvdrental
 */
class DvdrentalAsset extends AssetBundle
{
    public $sourcePath = '@dvdrental/assets';
    public $css = [
        'css/dvdrental.css',
    ];
    public $js = [
        'js/dvdrental.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
