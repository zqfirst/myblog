<?php

namespace backend\services\system;
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/2/27
 * Time: 22:47
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\services\system\controllers';

    public function init(){
        parent::init();
    }
}