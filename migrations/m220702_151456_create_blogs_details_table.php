<?php
/**
 * Astashenkov
**/

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blogs_details}}`.
 */
class m220702_151456_create_blogs_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blogs_details}}', [
            'id'        => $this->primaryKey(),
            'blog_id'   => $this->integer()->notNull(),
            'lang_code' => $this->string()->notNull()->defaultValue('ru'),
            'title'     => $this->string(),
            'img_url'   => $this->string(),
            'body'      => $this->text(),
        ]);

        // creates index for column `blog_id`
        $this->createIndex(
            'idx-blog-blog_id',
            'blogs_details',
            'blog_id'
        );

        // creates unique index for columns `blog_id', 'lang_code`
        $this->createIndex (
            'idx-blog_id-lang_code',
            'blogs_details',
            ['blog_id', 'lang_code'],
            true
        );

        // add foreign key for table `blog`
        $this->addForeignKey(
            'fk-blog-blog_id',
            'blogs_details',
            'blog_id',
            'blog',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `blog`
        $this->dropForeignKey(
            'fk-blog-blog_id',
            'blogs_details'
        );

        // drops index for column `blog_id`
        $this->dropIndex(
            'idx-blog-blog_id',
            'blogs_details'
        );

        // drops index for columns `blog_id-lang_code`
        $this->dropIndex(
            'idx-blog_id-lang_code',
            'blogs_details'
        );

        $this->dropTable('{{%blogs_details}}');
    }
}
