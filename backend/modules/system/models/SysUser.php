<?php

namespace backend\modules\system\models;

use common\libs\helpers\AesHelper;
use common\libs\helpers\ConfigHelper;
use Yii;

/**
 * This is the model class for table "sys_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $phone_encrypt
 * @property string $passwd
 * @property string $salt
 * @property string $status
 * @property string $create_time
 * @property string $update_time
 */
class SysUser extends \yii\db\ActiveRecord
{
    const STATUS_NORMAL = 1;
    const STATUS_BIND = 0;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'passwd'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['username', 'phone_encrypt'], 'string', 'max' => 45],
            [['passwd', 'salt'], 'string', 'max' => 100],
            [['status'], 'integer', 'max' => 2],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'phone_encrypt' => 'Phone Encrypt',
            'passwd' => 'Passwd',
            'salt' => 'Salt',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    public function getPhone()
    {
        return AesHelper::decrypt($this->phone_encrypt, ConfigHelper::getUserPhoneAesKey());
    }

    public function getStatusName()
    {
        switch ($this->status){
            case 0 :
                return '禁用';
            case 1:
                return '正常';
        }
    }

    public function addUser(Array $data)
    {
        $user = new self;
        $user->username = $data['username'];
        $user->salt = self::getSalt();
        $user->passwd = Yii::$app->getSecurity()->generatePasswordHash($data['passwd'].$user->salt);
        $user->phone_encrypt = AesHelper::encrypt($data['phone'], ConfigHelper::getUserPhoneAesKey());
        if($user->validate() && $user->save()){}
        else{var_dump($user->getErrors());exit;}
        return $user->validate() && $user->save() ? true : false;
    }

    static private function getSalt()
    {
        return Yii::$app->getSecurity()->generateRandomString();
    }
}
