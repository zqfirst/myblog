<?php

namespace backend\modules\system\lib\auth;

use Yii;
use yii\base\Action;
use yii\base\ActionFilter;
use yii\di\Instance;
use yii\web\ForbiddenHttpException;
use yii\web\User;

class UserAuthControl extends ActionFilter {

	/**
	 * @var User|array|string the user object representing the authentication status or the ID of the user application component.
	 * Starting from version 2.0.2, this can also be a configuration array for creating the object.
	 */
	public $user = 'user';
	/**
	 * @var callable a callback that will be called if the access should be denied
	 * to the current user. If not set, [[denyAccess()]] will be called.
	 *
	 * The signature of the callback should be as follows:
	 *
	 * ~~~
	 * function ($rule, $action)
	 * ~~~
	 *
	 * where `$rule` is the rule that denies the user, and `$action` is the current [[Action|action]] object.
	 * `$rule` can be `null` if access is denied because none of the rules matched.
	 */
	public $denyCallback;
	/**
	 * @var array the default configuration of access rules. Individual rule configurations
	 * specified via [[rules]] will take precedence when the same property of the rule is configured.
	 */
//    public $ruleConfig = ['class' => 'yii\filters\AccessRule'];
	/**
	 * @var array a list of access rule objects or configuration arrays for creating the rule objects.
	 * If a rule is specified via a configuration array, it will be merged with [[ruleConfig]] first
	 * before it is used for creating the rule object.
	 * @see ruleConfig
	 */
	public $rules = [];

	/**
	 * Initializes the [[rules]] array by instantiating rule objects from configurations.
	 */
	public function init()
	{
		parent::init();
		$this->user = Instance::ensure( $this->user, User::className() );
	}

	/**
	 * This method is invoked right before an action is to be executed (after all possible filters.)
	 * You may override this method to do last-minute preparation for the action.
	 *
	 * @param Action $action the action to be executed.
	 *
	 * @return boolean whether the action should continue to be executed.
	 */
	public function beforeAction( $action )
	{
		$path = \Yii::$app->requestedRoute ?: \Yii::$app->defaultRoute;
		if( substr( $path, 0, 1 ) != '/' ) {
			$path = '/' . $path;
		}
		if( ! Yii::$app->user->identity && $path != \Yii::$app->user->loginUrl ) {
			$this->denyReturn( '请登录', \Yii::$app->user->loginUrl );
		}

		$auth_check = UserAuthCheck::checkAuthByPath( \Yii::$app->user->identity, $path );
		if( $auth_check ) {
			return true;
		} else {
			$this->denyReturn();
		}

		return true;
	}

	/**
	 * Denies the access of the user.
	 * The default implementation will redirect the user to the login page if he is a guest;
	 * if the user is already logged, a 403 HTTP exception will be thrown.
	 *
	 * @param User $user the current user
	 *
	 * @throws ForbiddenHttpException if the user is already logged in.
	 */
	protected function denyAccess( $user )
	{
		if( $user->getIsGuest() ) {
			$user->loginRequired();
		} else {
			throw new ForbiddenHttpException( Yii::t( 'yii', 'You are not allowed to perform this action.' ) );
		}
	}

	private function denyReturn( $msg = '没有权限进行此操作', $url = '/system/index/deny' )
	{
		if( Yii::$app->request->isAjax ) {
			echo json_encode( [ 'result' => 0, 'message' => $msg ] );
			exit;
		}

		return Yii::$app->getResponse()->redirect( $url );
	}
}