<?php

namespace wap\controllers;

use common\libs\helpers\CacheHelper;
use common\libs\helpers\ConfigHelper;
use common\libs\http\Http;
use yii\web\Controller;

class BaseController extends Controller {

	public $hasTop = true;
	public $hasFoot = true;

	public function init()
	{
		//如果不是手机端 就跳转到pc端页面
		if(isset(\Yii::$app->devicedetect) && ! \Yii::$app->devicedetect->isMobile() ) {
			$this->identifyRedirect();
		}
		parent::init(); // TODO: Change the autogenerated stub
	}

	/**
	 * 确定路由的导向规则
	 */
	private function identifyRedirect(){
		$pathInfo        = \Yii::$app->request->pathInfo;
		$pc_route        = CacheHelper::get( CacheHelper::CACHE_PC_ROUTE_ARR ) ?: [];
		$pc_except_Route = CacheHelper::get( CacheHelper::CACHE_PC_EXCEPT_ROUTE_ARR ) ?: [];;
		$pc_request = ConfigHelper::getPcUrl() . $pathInfo;

		if(in_array( $pathInfo, $pc_route )) {
			$this->redirect( $pc_request );
		} elseif(in_array( $pathInfo, $pc_except_Route )) {
			//没有 就不做处理
		} else{
			//①如果不在有效路由 而且 无效路由为空或者不在无效路由
			//②如果不在无效路由 而且 有效路由为空或者不在有效路由 则重新更新缓存
			if( Http::check_remote_file_exists( $pc_request ) ) {
				//添加到存在路由
				array_push( $pc_route, $pathInfo );
				CacheHelper::set(
					CacheHelper::CACHE_PC_ROUTE_ARR,
					array_unique( $pc_route ),
					60 * 60 * 24 );

				$this->redirect( $pc_request );
				exit;
			} else {
				//如果不存在 就添加到不存在的路由
				array_push( $pc_except_Route, $pathInfo ) &&
				CacheHelper::set(CacheHelper::CACHE_PC_EXCEPT_ROUTE_ARR,
					array_unique( $pc_except_Route ),
					60 * 60 * 24);
			}
		}
	}
}