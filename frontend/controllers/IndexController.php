<?php

namespace frontend\controllers;

use common\libs\helpers\ArticleHelper;
use common\libs\http\RequestHelper;
use Yii;
use yii\data\Pagination;

class IndexController extends BaseController {

	public $hasNav = false;
	private $page_size = 5;

	public function actionIndex() {

		$article    = ArticleHelper::getRecommendList(RequestHelper::get( 'page', 1 ), $this->page_size );
		$newArticle = ArticleHelper::getRecentList( 1, 10 );

		return $this->render( 'index', [
			'articleList' => $article['list'],
			'newArticleList' => $newArticle['list'],
			'pages'          => new Pagination( [ 'totalCount' => $article['total'], 'pageSize' => $this->page_size ] )
		] );
	}
}