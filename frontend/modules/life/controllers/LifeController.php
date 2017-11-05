<?php
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/3/12
 * Time: 19:30
 */
namespace frontend\modules\life\controllers;

use Yii;

class LifeController extends \frontend\controllers\BaseController
{
    /* *
     * @TODO 慢生活
     * */
    public function actionLife()
    {
        $this->words='“慢生活”不是懒惰，放慢速度不是拖延时间，而是让我们在生活中寻找到平衡。';
        return $this->render('life');
    }

    /* *
     * @TODO 闲言碎语
     */
    public function actionSay()
    {
        $this->words = '删删写写，回回忆忆，虽无法行云流水，却也可碎言碎语。';
       return $this->render('say');
    }
}