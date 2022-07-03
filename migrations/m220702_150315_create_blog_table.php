<?php
/**
 * Astashenkov
**/

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog}}`.
 */
class m220702_150315_create_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog}}', [
            'id'         => $this->primaryKey(),
            'alias'      => $this->string()->notNull()->unique(),
            'author_id'  => $this->integer()->notNull()->defaultValue(1),
            'status'     => $this->string(1)->notNull()->defaultValue('A'),
            'img_url'    => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-blog-author_id',
            'blog',
            'author_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-blog-author_id',
            'blog',
            'author_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-blog-author_id',
            'blog'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-blog-author_id',
            'blog'
        );

        $this->dropTable('{{%blog}}');
    }
}

