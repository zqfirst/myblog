<?php

namespace wap\controllers;

use common\libs\helpers\ArticleHelper;
use common\libs\http\RequestHelper;
use yii\data\Pagination;

class IndexController extends BaseController {

	private $page_size = 5;

	public function actionIndex()
	{
		$article    = ArticleHelper::getRecommendList( RequestHelper::get( 'page', 1 ), $this->page_size );

		return $this->render( 'index', [
			'articleList'    => $article['list'],
			'pages'          => new Pagination( [ 'totalCount' => $article['total'], 'pageSize' => $this->page_size ] )
		] );
	}
}