<?php

namespace common\models\blog;

use Yii;

/**
 * This is the model class for table "blog_article_extend".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $content
 * @property string $create_time
 * @property string $update_time
 */
class BlogArticleExtend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_article_extend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
