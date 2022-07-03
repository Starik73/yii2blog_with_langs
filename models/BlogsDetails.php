<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blogs_details".
 *
 * @property int $id
 * @property int $blog_id
 * @property string $lang_code
 * @property string|null $title
 * @property string|null $body
 *
 * @property Blog $blog
 */
class BlogsDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogs_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_id'], 'required'],
            [['blog_id'], 'integer'],
            [['body'], 'string'],
            [['lang_code', 'title'], 'string', 'max' => 255],
            [['blog_id', 'lang_code'], 'unique', 'targetAttribute' => ['blog_id', 'lang_code']],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::class, 'targetAttribute' => ['blog_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'blog_id' => Yii::t('app', 'Blog ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
        ];
    }

    /**
     * Gets query for [[Blog]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::class, ['id' => 'blog_id']);
    }
}
