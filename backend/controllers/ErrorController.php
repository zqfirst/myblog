<?php
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/4/6
 * Time: 21:56
 */

namespace backend\controllers;

class ErrorController extends BaseController
{
    public function actionError()
    {
        return $this->render('error');
    }
}