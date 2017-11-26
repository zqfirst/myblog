<?php

namespace wap\modules\blog\controllers;

use common\libs\helpers\ArticleHelper;
use common\libs\http\RequestHelper;
use common\models\blog\BlogArticle;
use wap\controllers\BaseController;
use yii\data\Pagination;

class BlogController extends BaseController {

	private $page_size = 4;

	/**
	 * @TODO 获取技术文章的首页列表
	 */
	public function actionIndex()
	{
		$article    = ArticleHelper::getRecentList( RequestHelper::get( 'page', 1 ), $this->page_size );

		return $this->render( 'techList', [
			'articleList'    => $article['list'],
			'pages'          => new Pagination( [ 'totalCount' => $article['total'], 'pageSize' => $this->page_size ] )
		] );
	}

	/**
	 * @TODO 文章的详情页面
	 */
	public function actionDetail( $article_id )
	{
		$articleModel   = BlogArticle::findOne( [ 'id' => $article_id, 'is_delete' => BlogArticle::NOT_DELETE ] );

		return $this->render( 'teacDetail', [
			'articleModle'   => $articleModel,
		] );
	}
}