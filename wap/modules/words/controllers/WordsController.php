<?php

namespace wap\modules\words\controllers;

use common\libs\helpers\WordsHelper;
use common\libs\http\RequestHelper;
use wap\controllers\BaseController;
use yii\data\Pagination;

class WordsController extends BaseController {

	private $page_size = 3;

	public function actionWordsList()
	{
		$words = WordsHelper::getRecentList( RequestHelper::get( 'page', 1 ), $this->page_size );

		return $this->render( 'wordsList', [
			'wordsList' => $words['list'],
			'pages'     => new Pagination( [ 'totalCount' => $words['total'], 'pageSize' => $this->page_size ] )
		] );
	}
}