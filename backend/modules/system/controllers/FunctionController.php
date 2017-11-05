<?php

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;
use backend\modules\system\models\SysFunction;
use common\libs\http\RequestHelper;
use Yii;
use yii\web\Response;

class FunctionController extends BaseController
{
    public function actionIndex()
    {
        $data = [
            'addFunctionUrl' => '/system/function/add-function?type=add',
            'functionList' => SysFunction::getAll()
        ];
        return $this->render('list', $data);
    }

    public function actionAddFunction()
    {
        $type = RequestHelper::get('type','add');
        $function_id = RequestHelper::get('id');
        $functions = SysFunction::getFunctionLevel();
        if(Yii::$app->request->isPost)
        {
        	Yii::$app->response->format = Response::FORMAT_JSON;
        	try {
		        $res = SysFunction::editFunction(RequestHelper::post());
		        $msg = '成功';
	        } catch (\Exception $ex) {
		        $res = false;
		        $msg = $ex->getMessage();
	        }
	        $code =$res?\ResponseCode::SUCCESS_CODE : \ResponseCode::FAIL_CODE;
	        return ['code'=>$code ,'msg'=>$msg];

        }
        return $this->render('edit', [
            'functions'=>$functions,
            'type' => $type,
	        'model' => SysFunction::findOne(['id'=>$function_id])
        ]);
    }
}