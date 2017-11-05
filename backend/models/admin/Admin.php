<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "my_admin".
 *
 * @property string $id
 * @property resource $username
 * @property resource $passwd
 * @property string $phone
 * @property string $create_time
 * @property string $update_time
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['username'], 'string', 'max' => 32],
            [['passwd'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键id',
            'username' => '用户名',
            'passwd' => '用户密码',
            'phone' => '手机号',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }
}
