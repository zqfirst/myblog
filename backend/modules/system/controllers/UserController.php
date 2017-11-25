<?php

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;
use common\libs\http\RequestHelper;
use backend\modules\system\models\SysUser;
use Yii;

class UserController extends BaseController {
	public function actionIndex()
	{
		$data = [
			'userUrl' => '/system/user/edit-user',
			'userList'   => SysUser::find()->all()
		];

		return $this->render( 'list', $data );
	}

	/**
	 * @return array|string|\yii\web\Response
	 */
	public function actionEditUser()
	{
		$userId = RequestHelper::getInt( 'id' );
		$type   = RequestHelper::get( 'type', 'add' );
		if ( $userId ) {
			$userInfo = SysUser::findOne( [ 'id' => $userId ] );
		}

		if ( Yii::$app->request->isPost ) {
			if(( new SysUser() )->addUser( RequestHelper::post() ) ){
				return ['code'=>\ResponseCode::SUCCESS_CODE, 'msg'=>'成功', 'url'=>'/system/user/index'];
			}else{
				return ['code'=>\ResponseCode::FAIL_CODE, 'msg'=>'数据处理失败'];
			}
		}

		return $this->render( 'edit', [
			'user' => isset( $userInfo ) ? $userInfo : null,
			'type' => $type
		] );
	}
}