<?php

namespace common\models\blog;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property integer $is_valid
 * @property string $parent_id
 * @property string $create_time
 * @property string $update_time
 */
class BlogCategory extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'blog_category';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name','is_valid','parent_id'],'required'],
			[ [ 'create_time', 'update_time' ], 'safe' ],
			[ [ 'name', 'parent_id' ], 'string', 'max' => 45 ],
			[ [ 'image' ], 'string', 'max' => 100 ],
			[ [ 'is_valid' ], 'integer'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'          => 'ID',
			'name'        => 'Name',
			'image'        => 'Image',
			'is_valid'        => 'Is Valid',
			'parent_id'   => 'Parent ID',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		];
	}

	public function getCategory( $first_id = null )
	{
		if ( $first_id ) {
			return self::findAll( [ 'parent_id' => $first_id ] );
		}

		return self::findAll( [ 'parent_id' => 0 ] );
	}

	static public function getAll()
	{
		$returnArr = [];
		$functions = self::findAll(['parent_id'=>0]);
		foreach ($functions as $function)
		{
			$returnArr[]  = $function;
			$tmpArr = self::findAll(['parent_id'=>$function->id]);
			$returnArr = $tmpArr ? array_merge($returnArr, $tmpArr) : $returnArr;
		}
		return $returnArr;
	}
}
