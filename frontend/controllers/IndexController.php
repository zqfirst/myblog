<?php

namespace frontend\controllers;

use common\libs\helpers\ArticleHelper;
use Yii;

class IndexController extends BaseController {

	public $hasNav = false;

	public function actionIndex() {

		$articleList    = ArticleHelper::getRecommendList();
		$newArticleList = ArticleHelper::getRecentList( 1, 10 );

		return $this->render( 'index', [
			'articleList' => $articleList,
			'newArticleList' => $newArticleList,
		] );
	}
}