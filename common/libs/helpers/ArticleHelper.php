<?php

namespace common\libs\helpers;

use common\models\blog\BlogArticle;

class ArticleHelper {

	/**
	 * 获取最新的文章列表
	 */
	static public function getRecentList( $page = 1, $pagesize = 5 )
	{
		$offset = ( ( $page >= 1 ? intval( $page ) : 1 ) - 1 ) * $pagesize;
		$query  = BlogArticle::find()->where( [ 'is_delete' => BlogArticle::NOT_DELETE ] )->andFilterWhere( [] );
		return [
			'total' => $query->count(),
			'list' => $query->orderBy( 'create_time DESC' )->offset( $offset )->limit( $pagesize )->all()
		];
	}

	/**
	 * 获取推荐的文章列表
	 */
	static public function getRecommendList( $page = 1, $pagesize = 5 )
	{
		$offset = ( ( $page >= 1 ? intval( $page ) : 1 ) - 1 ) * $pagesize;

		$query = BlogArticle::find()->where( [ 'is_delete' => BlogArticle::NOT_DELETE ] )->andFilterWhere( [ 'is_recommend' => BlogArticle::RECOMMEND ] );
		return [
			'total' => $query->count(),
			'list' => $query->orderBy( 'create_time DESC' )->offset( $offset )->limit( $pagesize )->all()
		];
	}
}