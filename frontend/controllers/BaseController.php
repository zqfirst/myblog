<?php
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/2/27
 * Time: 22:44
 */

namespace frontend\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
    public $layout = '/main';
    public $hasTop = true;
    public $hasFoot = true;
    public $hasNav = true;
    public $words = '';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}