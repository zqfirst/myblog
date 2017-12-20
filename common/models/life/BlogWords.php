<?php

namespace common\models\life;

use Yii;

/**
 * This is the model class for table "blog_words".
 *
 * @property integer $id
 * @property string $words
 * @property string $images
 * @property integer $is_show
 * @property integer $is_delete
 * @property string $create_time
 * @property string $update_time
 */
class BlogWords extends \yii\db\ActiveRecord
{
	const SHOW = 1;
	const NOT_SHOW = 0;

	const DELETE = 1;
	const NOT_DELETE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_words';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['words'], 'string', 'max' => 500],
            [['images'], 'string', 'max' => 100],
            [['is_delete', 'is_show'], 'integer', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'words' => '碎言碎语',
            'images' => '图片地址',
            'is_delete' => '是否删除',
            'is_show' => '是否展示',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
