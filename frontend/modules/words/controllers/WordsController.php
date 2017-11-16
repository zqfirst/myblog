<?php
/**
 * Created by PhpStorm.
 * User: 张强
 * Date: 2017/3/5
 * Time: 22:52
 */

namespace frontend\modules\words\controllers;

use common\models\life\BlogWords;
use frontend\controllers\BaseController;

class WordsController extends BaseController {

//	public $words = '你，生命中最重要的过客，之所以是过客，因为你未曾为我停留。';
	public $words = '删删写写，回回忆忆，虽无法行云流水，却也可碎言碎语。';

	public function actionWordsList() {
		$wordsList = BlogWords::findAll( [ 'is_show' => BlogWords::SHOW, 'is_delete' => BlogWords::NOT_DELETE ] );

		return $this->render( 'wordsList', [
			'wordsList' => $wordsList
		] );
	}
}