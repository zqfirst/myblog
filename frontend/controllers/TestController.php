<?php

namespace frontend\controllers;

use common\libs\http\Http;

class TestController extends BaseController
{
    public function actionTest()
    {
        $http = new Http();
        $url1 = 'https://app.wangcaigu.com/index/index/init?clienttype=ios';
        $url2 = 'https://app.wangcaigu.com/deal/deal/list?clienttype=ios';

        $http->get($url1);
    }
}