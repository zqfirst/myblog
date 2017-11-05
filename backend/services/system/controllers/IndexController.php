<?php

namespace backend\services\system\controllers;

use backend\controllers\BaseController;

class IndexController extends BaseController {

	public function actionIndex(){
		return $this->render('index');
	}
}