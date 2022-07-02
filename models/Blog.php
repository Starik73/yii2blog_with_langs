<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $alias
 * @property int $author_id
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $author
 * @property BlogsDetails[] $blogsDetails
 * @property BlogsMetaData[] $blogsMetaDatas
 */
class Blog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'created_at', 'updated_at'], 'required'],
            [['author_id', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
            [['alias'], 'unique'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'author_id' => Yii::t('app', 'Author ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[BlogsDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogsDetails($lang_code = 'ru')
    {
        return $this->hasMany(BlogsDetails::class, ['blog_id' => 'id', 'lang_code' => $lang_code]);
    }

    /**
     * Gets query for [[BlogsMetaDatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogsMetaDatas($lang_code = 'ru')
    {
        return $this->hasMany(BlogsMetaData::class, ['blog_id' => 'id', 'lang_code' => $lang_code]);
    }
}
