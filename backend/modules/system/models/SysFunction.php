<?php

namespace backend\modules\system\models;

use common\libs\helpers\ArrayHelper;

/**
 * This is the model class for table "sys_function".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $route
 * @property integer $parent_id
 * @property string $class
 * @property string $redict_url
 * @property integer $is_valid
 * @property string $create_time
 * @property string $update_time
 */
class SysFunction extends \yii\db\ActiveRecord {
	const MENU = 2;
	const FUNC = 1;
	const VALID = 1;
	const NOT_VALID = 0;

	public $children;
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'sys_function';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'type', 'parent_id', 'is_valid' ], 'integer' ],
			[ [ 'create_time', 'update_time' ], 'safe' ],
			[ [ 'name', 'redirect_url', 'route' ], 'string', 'max' => 45 ],
			[ [ 'class' ], 'string', 'max' => 50 ],
		];
	}

	public function getAll()
	{
		$returnArr = [];
		$functions = self::findAll(['parent_id'=>0, 'type'=>self::MENU]);
		foreach ($functions as $function)
		{
			$returnArr[]  = $function;
			$tmpArr = self::findAll(['parent_id'=>$function->id, 'type'=>self::MENU]);
			$returnArr = $tmpArr ? array_merge($returnArr, $tmpArr) : $returnArr;
		}
		return $returnArr;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'           => 'ID',
			'name'         => 'Name',
			'type'         => 'Type',
			'parent_id'    => 'Parent ID',
			'class'        => 'Class',
			'route'        => 'Route',
			'redirect_url' => 'Redirect Url',
			'is_valid'     => 'Is Valid',
			'create_time'  => 'Create Time',
			'update_time'  => 'Update Time',
		];
	}

	public function getValidName()
	{
		switch ( $this->is_valid ) {
			case 0 :
				$valid_name = '无效';
				break;
			case 1:
				$valid_name = '有效';
				break;
			default:
				$valid_name = '';
		}

		return $valid_name;
	}

	public function getTypeName()
	{
		switch ( $this->type ) {
			case 1:
				$type_name = '功能点';
				break;
			case 2:
				$type_name = '菜单点';
				break;
			default:
				$type_name = '';
		}

		return $type_name;
	}

	static public function getFunctionLevel()
	{
		$functions = self::find()->asArray()->all();

		return ArrayHelper::unLimitLevelTree( $functions, 'parent_id', 0 );
	}

	static public function editFunction( Array $data )
	{
//	    $data['function_id'] = 1;
		if ( isset( $data['function_id'] ) && $data['function_id'] ) {
			$functionModel = self::findOne( [ 'id' => $data['function_id'] ] );
		}

		$functionModel = isset( $functionModel ) && $functionModel ? $functionModel : ( new self );
		if ( $functionModel->load( $data, '' ) && $functionModel->validate() ) {
			return $functionModel->save();
		} else {
			throw new \Exception( '数据错误' );
		}
	}
}
