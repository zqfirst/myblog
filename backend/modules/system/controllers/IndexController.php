<?php

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDeny()
    {
        return $this->render('deny');
    }
}