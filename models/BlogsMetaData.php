<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "blogs_meta_data".
 *
 * @property int $id
 * @property int $blog_id
 * @property string $lang_code
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $og_title
 * @property string|null $og_type
 * @property string|null $og_url
 * @property string|null $og_image
 * @property string|null $og_image_width
 * @property string|null $og_image_height
 * @property string|null $og_description
 * @property string|null $og_site_name
 *
 * @property Blog $blog
 */
class BlogsMetaData extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogs_meta_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_id'], 'required'],
            [['blog_id'], 'integer'],
            [['lang_code', 'keywords', 'description', 'og_title', 'og_type', 'og_url', 'og_image', 'og_image_width', 'og_image_height', 'og_description', 'og_site_name'], 'string', 'max' => 255],
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
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'og_title' => Yii::t('app', 'Og Title'),
            'og_type' => Yii::t('app', 'Og Type'),
            'og_url' => Yii::t('app', 'Og Url'),
            'og_image' => Yii::t('app', 'Og Image'),
            'og_image_width' => Yii::t('app', 'Og Image Width'),
            'og_image_height' => Yii::t('app', 'Og Image Height'),
            'og_description' => Yii::t('app', 'Og Description'),
            'og_site_name' => Yii::t('app', 'Og Site Name'),
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
