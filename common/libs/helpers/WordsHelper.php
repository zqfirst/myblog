<?php

namespace common\libs\helpers;

use common\models\life\BlogWords;

class WordsHelper {
	public static function getRecentList($page = 1, $pagesize = 5){
		$offset = ( ( $page >= 1 ? intval( $page ) : 1 ) - 1 ) * $pagesize;
		$query  = BlogWords::find()
		               ->where( [ 'is_delete' => BlogWords::NOT_DELETE ] )
		               ->andFilterWhere( ['is_show'=>BlogWords::SHOW] );
		return [
			'total' => $query->count(),
			'list' => $query->orderBy( 'create_time DESC' )->offset( $offset )->limit( $pagesize )->all()
		];
	}
}