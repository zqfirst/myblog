<?php
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/3/5
 * Time: 22:52
 */

namespace frontend\modules\words\controllers;

use frontend\controllers\BaseController;

class WordsController extends BaseController
{
    public function actionWordsList()
    {
        $this->words = '你，生命中最重要的过客，之所以是过客，因为你未曾为我停留。';
        return $this->render('wordsList');
    }

}