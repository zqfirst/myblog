<?php
namespace backend\modules\system\lib\auth;

use yii\base\Model;
use yii\db\ActiveRecord;

class UserAuthCheck extends Model
{

    /**
     * 通过功能点编号判断是否有权限操作
     * @param int $Emp_id
     * @param string $funcSn
     */
    public static function checkAuthByCode($loginUser, $funcSn = '')
    {
    	return true;
    }

    /**
     * 通过url地址判断是否有权限进行操作
     * @param string $Emp_id
     * @param string $funcSn
     */
    public static function checkAuthByPath($loginUser, $path = '')
    {
    	return true;
    }
}