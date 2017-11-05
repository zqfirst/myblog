<?php

namespace backend\modules\system\models;

use Yii;

/**
 * This is the model class for table "sys_group_function".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $function_id
 */
class SysGroupFunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_group_function';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'function_id'], 'required'],
            [['group_id', 'function_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'function_id' => 'Function ID',
        ];
    }
}
