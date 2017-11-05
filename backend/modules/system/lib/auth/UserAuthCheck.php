<?php
namespace backend\modules\system\lib\auth;

use backend\modules\system\models\SysEmployee;
use yii\base\Model;
use yii\db\ActiveRecord;

class UserAuthCheck extends Model
{

    /**
     * 通过功能点编号判断是否有权限操作
     * @param int $Emp_id
     * @param string $funcSn
     */
    public static function checkAuthByCode(SysEmployee $loginUser, $funcSn = '')
    {
        if (!empty($funcSn)) {
            $connect = ActiveRecord::getDb();
            $session = \Yii::$app->session;
            $currentSysSn = $session->has('currentSysSn') ? $session->get('currentSysSn') : '' ;
            if (empty($currentSysSn)) {
                $sql = "SELECT A.*
                    FROM sys_function AS A
                      INNER JOIN sys_role_function AS B ON A.id = B.Func_id
                      INNER JOIN sys_role_employee AS C ON B.Role_id = C.Role_id
                      INNER JOIN sys_employee AS D ON C.Emp_id = D.id
                    where D.id = :Emp_id AND A.funcSn = :funcSn AND A.isValid =1 and A.isDelete =0 AND D.isValid =1 and D.isDelete =0";
                $authExist = $connect->createCommand($sql, [':Emp_id' => $loginUser->id, ':funcSn' => $funcSn])->queryScalar();
            } else {
                $sql = "SELECT A.*
                    FROM sys_function AS A
                      INNER JOIN sys_role_function AS B ON A.id = B.Func_id
                      INNER JOIN sys_role_employee AS C ON B.Role_id = C.Role_id
                      INNER JOIN sys_employee AS D ON C.Emp_id = D.id
                    where D.id = :Emp_id AND A.funcSn = :funcSn AND A.isValid =1 and A.isDelete =0 AND D.isValid =1 and D.isDelete =0 and FIND_IN_SET(:sysSn, A.sysSns) > 0 and FIND_IN_SET(:sysSn, D.sysSns) > 0";
                $authExist = $connect->createCommand($sql, [':Emp_id' => $loginUser->id, ':funcSn' => $funcSn, ':sysSn' => $currentSysSn])->queryScalar();
            }

            if ($authExist) {
                return true;
            }
        }
        return false;
    }

    /**
     * 通过url地址判断是否有权限进行操作
     * @param string $Emp_id
     * @param string $funcSn
     */
    public static function checkAuthByPath(SysEmployee $loginUser, $path = '')
    {
        if (!empty($path)) {
            $connect = ActiveRecord::getDb();

            $funcSql = "SELECT id FROM sys_function WHERE path= :path AND isValid =1 and isDelete =0";
            $funcExist = $connect->createCommand($funcSql, [':path' => $path])->queryOne();
            if (!$funcExist) { //如果该路径不存在权限表,则没有权限控制
                return true;
            }
            $session = \Yii::$app->session;
            $currentSysSn = $session->has('currentSysSn') ? $session->get('currentSysSn') : '' ;
            if (empty($currentSysSn)) {
                $sql = "SELECT A.*
                    FROM sys_function AS A
                      INNER JOIN sys_role_function AS B ON A.id = B.Func_id
                      INNER JOIN sys_role_employee AS C ON B.Role_id = C.Role_id
                      INNER JOIN sys_employee AS D ON C.Emp_id = D.id
                    where D.id = :Emp_id AND A.path = :path AND A.isValid = 1 and A.isDelete = 0 AND D.isValid =1 and D.isDelete = 0";
                $authExist = $connect->createCommand($sql, [':Emp_id' => $loginUser->id, ':path' => $path])->queryScalar();
            } else {
                $sql = "SELECT A.*
                    FROM sys_function AS A
                      INNER JOIN sys_role_function AS B ON A.id = B.Func_id
                      INNER JOIN sys_role_employee AS C ON B.Role_id = C.Role_id
                      INNER JOIN sys_employee AS D ON C.Emp_id = D.id
                    where D.id = :Emp_id AND A.path = :path AND A.isValid = 1 and A.isDelete = 0 AND D.isValid = 1 and D.isDelete = 0 and FIND_IN_SET(:sysSn, A.sysSns) > 0 and FIND_IN_SET(:sysSn, D.sysSns) > 0";
                $authExist = $connect->createCommand($sql, [':Emp_id' => $loginUser->id, ':path' => $path, 'sysSn' => $currentSysSn])->queryScalar();
            }
            if ($authExist) {
                return true;
            }
        }
        return false;
    }

    //获取当前登录人所能查看的数据所属的emp_id
    public static function getDataAuthUids(\yii\web\IdentityInterface $identity)
    {
        return [1, 2, 3, 4];
    }
}