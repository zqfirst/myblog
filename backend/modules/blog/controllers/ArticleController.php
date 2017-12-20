<?php

namespace backend\modules\blog\controllers;

use backend\controllers\BaseController;
use common\libs\http\RequestHelper;
use common\models\blog\BlogArticle;
use common\models\blog\BlogArticleExtend;
use common\models\blog\BlogCategory;

class ArticleController extends BaseController {

	public function actionIndex() {
		$data = [
			'addArticleUrl' => '/blog/article/edit-article?type=add',
			'articleList'   => BlogArticle::find()->where( [ 'is_delete' => BlogArticle::NOT_DELETE ] )->all()
		];

		return $this->render( 'index', $data );
	}

	public function actionDelete( $article_id ) {
		if( BlogArticle::updateAll( [ 'is_delete' => BlogArticle::DELETE ], [ 'id' => $article_id ] ) ) {
			return [ 'code' => \ResponseCode::SUCCESS_CODE, 'msg' => '成功', 'data' => [ 'url' => '/blog/article/index' ] ];
		} else {
			return ['code'=>\ResponseCode::FAIL_CODE, 'msg'=>'删除失败'];
		}
	}

	public function actionEditArticle() {
		$article_id = RequestHelper::get( 'id' ) ?: RequestHelper::post( 'id' );
		$model      = BlogArticle::findOne( [ 'id' => $article_id ] );
		if( \Yii::$app->request->isPost ) {
			if( ! $model ) {
				$model = new BlogArticle();
			}
			if( $model->load( RequestHelper::post(), '' ) && $model->validate() && $model->save() ) {
				//添加到扩展信息
				$data         = [ 'content' => RequestHelper::post( 'content' ), 'article_id' => $model->id ];
				$articleModel = BlogArticleExtend::findOne( [ 'article_id' => $model->id ] ) ?: new BlogArticleExtend();
				$articleModel->load( $data, '' ) and $articleModel->save();

				return [ 'code' => 200, 'msg' => '成功', 'url' => '/blog/article/index' ];
			} else {
				return [ 'code' => 101, 'msg' => '失败，数据有误', 'url' => '/blog/article/index' ];
			}
		} else {
			$firstCategoryList = BlogCategory::getAll();
		}

		return $this->render( 'edit', [
			'type'              => RequestHelper::get( 'type' ),
			'model'             => $model,
			'firstCategoryList' => $firstCategoryList,
		] );
	}

	/**
	 * 回收站
	 */
	public function actionRecyle() {
	}
}