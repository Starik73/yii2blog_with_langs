<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blogs_meta_data}}`.
 */
class m220702_152159_create_blogs_meta_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blogs_meta_data}}', [
            'id'                 => $this->primaryKey(),
            'blog_id'            => $this->integer()->notNull(),
            'lang_code'          => $this->string()->notNull()->defaultValue('ru'),
            'keywords'           => $this->string()->defaultValue('PHP, HTML, CSS, JS'),
            'description'        => $this->string()->defaultValue('Blog astashenkov.ru PHP, HTML, CSS, JS'),
            'og_title'           => $this->string()->defaultValue('Blog astashenkov.ru PHP, HTML, CSS, JS'),
            'og_type'            => $this->string()->defaultValue('article'),
            'og_url'             => $this->string(),
            'og_image'           => $this->string(),
            'og_image_width'     => $this->string()->defaultValue('1200'),
            'og_image_height'    => $this->string()->defaultValue('630'),
            'og_description'     => $this->string()->defaultValue('PHP developer site'),
            'og_site_name'       => $this->string()->defaultValue('astashenkov.ru'),
        ]);

        // creates index for column `blog_id`
        $this->createIndex(
            'idx-blog-blog_id',
            'blogs_meta_data',
            'blog_id'
        );

        // creates unique index for columns `blog_id', 'lang_code`
        $this->createIndex (
            'idx-blog_id-lang_code',
            'blogs_meta_data',
            ['blog_id', 'lang_code'],
            true
        );

        // add foreign key for table `blog`
        $this->addForeignKey(
            'fk-blogs_meta_data-blog_id',
            'blogs_meta_data',
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
            'fk-blogs_meta_data-blog_id',
            'blogs_meta_data'
        );

        // drops index for column `blog_id`
        $this->dropIndex(
            'idx-blog-blog_id',
            'blogs_meta_data'
        );

        // drops index for columns `blog_id-lang_code`
        $this->dropIndex(
            'idx-blog_id-lang_code',
            'blogs_meta_data'
        );

        $this->dropTable('{{%blogs_meta_data}}');
    }
}