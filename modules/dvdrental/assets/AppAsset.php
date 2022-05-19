<?php

namespace app\modules\dvdrental\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@dvdrental/assets';
    public $css = [
        'css/dvdrental.css',
    ];
    public $js = [
    ];
    public $depends = [];
}
