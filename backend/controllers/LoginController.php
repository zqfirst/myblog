<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\web\Response;

class LoginController extends BaseController
{
    public $hasTop = false;
    public $hasFoot = false;
    public $layout = false;

    public function actionIndex()
    {
        $model = new LoginForm();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $model->login()) {
                return [ 'code' => 200, 'message' => '登陆成功', 'Const' => '/'];
            } else {
                return ['code' => 0, 'message' => '用户名或密码不正确'];
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}