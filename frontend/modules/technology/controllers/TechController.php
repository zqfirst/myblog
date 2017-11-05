<?php
namespace frontend\modules\technology\controllers;

use frontend\controllers\BaseController;

class TechController extends BaseController
{
    /**
     * @TODO 获取技术文章的首页列表
     */
    public function actionIndex()
    {
        $this->words='我们长路漫漫，只因学无止境。';
        return $this->render('techList');
    }

    /**
     * @TODO 文章的详情页面
     */
    public function actionDetail()
    {
        $this->hasNav = false;
        return $this->render('teacDetail');
    }
}