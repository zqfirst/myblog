<?php

namespace backend\controllers;

use backend\modules\system\models\LoginForm;
use Yii;
use yii\web\Response;

class LoginController extends BaseController {

	public $hasTop = false;
	public $hasFoot = false;
	public $layout = false;

	public function actionLogin()
	{
		if( \Yii::$app->user->identity ) {
			//如果已经登录 跳转首页
			$this->redirect( '/' );
		}
		$model = new LoginForm();
		if( Yii::$app->request->isAjax ) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			if( $model->load( [ 'LoginForm' => Yii::$app->request->post(), '' ] ) && $model->login() ) {
				return [ 'code' => 200, 'msg' => '登陆成功', 'url' => '/' ];
			} else {
				return [ 'code' => 0, 'msg' => '用户名或密码不正确' ];
			}
		}

		return $this->render( 'index', [ 'model' => $model ] );
	}

	/**
	 * 退出登录
	 *
	 * @return Response
	 */
	public function actionLoginOut()
	{
		if (Yii::$app->user->isGuest) {
			return $this->goHome();
		} else {
			Yii::$app->user->logout();
			return $this->redirect('/login/login');
		}
	}
}