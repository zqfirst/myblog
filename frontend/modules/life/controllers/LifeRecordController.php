<?php
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/3/11
 * Time: 19:57
 */

namespace frontend\modules\life\controllers;

class LifeRecordController extends \frontend\controllers\BaseController
{
    public function actionIndex(){
        return $this->render('index');
    }
}