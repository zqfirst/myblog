<?php
/**
 * Created by PhpStorm.
 * User: zhangqiang
 * Date: 17-8-29
 * Time: 下午8:29
 */

namespace backend\modules\blog\controllers;

use backend\controllers\BaseController;
use common\libs\http\RequestHelper;
use common\models\blog\BlogCategory;

class CategoryController extends BaseController {

	public function actionIndex()
	{
		$data = [
			'addCategoryUrl' => '/blog/category/edit?type=add',
			'categoryList'   => BlogCategory::getAll(),
		];

		return $this->render( 'index', $data );
	}

	public function actionEdit()
	{
		$type  = RequestHelper::get( 'type' );
		$id    = RequestHelper::get( 'id' );
		$model = BlogCategory::findOne( [ 'id' => $id ] );
		if ( \Yii::$app->request->isPost ) {
			$model = $model ?: ( new BlogCategory() );
			if($model->load(RequestHelper::post(),'') && $model->save())
			{
				return ['code'=>\ResponseCode::SUCCESS_CODE, 'msg'=>'成功'];
			}
			return ['code'=>\ResponseCode::FAIL_CODE, 'msg'=>'操作失败'];
		} else {
			$firstCategoryList  = BlogCategory::getAll();
		}

		return $this->render( 'edit', [
			'type'               => $type,
			'model'              => $model,
			'firstCategoryList'  => $firstCategoryList,
		] );
	}

	public function actionDelete()
	{
		$id = RequestHelper::get('id');
		if(BlogCategory::deleteAll(['id'=>$id]))
		{
			return ['code'=>\ResponseCode::SUCCESS_CODE, 'msg'=>'成功'];
		} else {
			return ['code'=>\ResponseCode::FAIL_CODE, 'msg'=>'操作失败'];
		}
	}
}