<?php

namespace backend\modules\words\controllers;

use backend\controllers\BaseController;
use common\libs\http\RequestHelper;
use common\models\life\BlogWords;

class WordsController extends BaseController {

	public function actionIndex() {
		return $this->render( 'index', [
			'addWordsUrl' => '/words/words/edit-words?type=add',
			'wordList' => BlogWords::find()->all()
		] );
	}

	public function actionEditWords() {
		$words_id = RequestHelper::get( 'id' ) ?: RequestHelper::post( 'id' );
		$model    = BlogWords::findOne( [ 'id' => $words_id ] ) ?: new BlogWords();
		if( \Yii::$app->request->isPost ) {
			if( $model->load( RequestHelper::post(), '' ) && $model->validate() && $model->save() ) {
				return [ 'code' => 200, 'msg' => '成功', 'data' => [ 'url' => '/words/words/index' ] ];
			} else {
				return [ 'code' => 101, 'msg' => '失败，数据有误', 'data' => [ 'url' => '/words/words/index' ] ];
			}
		}

		return $this->render( 'edit', [
			'type'  => RequestHelper::get( 'type' ),
			'model' => $model
		] );
	}
}