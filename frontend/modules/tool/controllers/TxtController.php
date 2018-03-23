<?php


namespace frontend\modules\tool\controllers;

use frontend\controllers\BaseController;

class TxtController extends BaseController
{
    public function actionGetZrxErrorData()
    {
        $files   = file(dirname(__DIR__) . "/data/error.txt");
        $newFile = dirname(__DIR__) . "/data/info.txt";
        foreach ($files as $file) {
            if (preg_match('/成功/', $file)) {
                continue;
            }

            file_put_contents($newFile, $file, FILE_APPEND);
        }

        die;
    }
}