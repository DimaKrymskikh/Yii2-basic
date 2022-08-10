<?php

namespace app\modules\dvdrental;

use Yii;
use yii\base\Module;

/**
 * Класс модуля dvdrental
 */
class DvdrentalModule extends Module
{
    public $controllerNamespace = 'app\modules\dvdrental\controllers';
    
    public function init()
    {
        parent::init();
        Yii::configure($this, require __DIR__ . '/dvdrentalConfig.php');
    }
}
