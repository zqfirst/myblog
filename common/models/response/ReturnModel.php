<?php

namespace common\models\response;

use common\libs\helpers\ArrayHelper;

class ReturnModel
{
    private $data = [];
    private $code = 10000;
    private $msg = '成功';

    public function setReturnData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setReturnMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function setReturnCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getReturnData($isObject = false)
    {
        $data = ['data'=>$this->data, 'msg'=>$this->msg, 'code'=>$this->code];
        return $isObject ?
            ArrayHelper::ToObject($data):
            $data;
    }
}