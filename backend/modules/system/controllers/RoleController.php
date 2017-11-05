<?php

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;

class RoleController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}