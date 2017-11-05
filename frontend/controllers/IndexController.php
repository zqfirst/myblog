<?php

namespace frontend\controllers;

use Yii;

class IndexController extends BaseController
{
    public function actionIndex(){
        $this->hasNav = false;
       return  $this->render('index');
    }
}