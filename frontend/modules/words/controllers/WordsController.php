<?php
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/3/5
 * Time: 22:52
 */

namespace frontend\modules\words\controllers;

use common\libs\helpers\WordsHelper;
use common\libs\http\RequestHelper;
use frontend\controllers\BaseController;
use yii\data\Pagination;

class WordsController extends BaseController {

	private $page_size = 5;
	public $words = '删删写写，回回忆忆，虽无法行云流水，却也可碎言碎语。';

	public function actionWordsList()
	{
		$words = WordsHelper::getRecentList( RequestHelper::get( 'page', 1 ), $this->page_size );

		return $this->render( 'wordsList', [
			'wordsList' => $words['list'],
			'pages'     => new Pagination( [ 'totalCount' => $words['total'], 'pageSize' => $this->page_size ] )
		] );
	}
}