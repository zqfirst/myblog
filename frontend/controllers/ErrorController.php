<?php
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/3/12
 * Time: 10:58
 */

namespace frontend\controllers;

class ErrorController extends BaseController
{
    public function actionError()
    {
        return $this->render('error');
    }
}