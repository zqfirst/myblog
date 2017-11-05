<?php

namespace backend\controllers;

/**
 * Class IndexController
 * @property
 * @package backend\controllers
 */
class IndexController extends BaseController
{
	/**
	 *
	 */
    public function actionIndex()
    {
        echo 222;
    }

    public function actionLogin()
    {
        return $this->goHome();
        echo 333;
    }
}