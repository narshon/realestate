<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_blog`.
 */
class m160804_122926_create_re_blog extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_blog', [
            'id' => $this->primaryKey(),
            'fk_user_id' => $this->integer(),
            'blog_title' => $this->text(),
            'blog_post' => $this->text(),
            'posted_date' => $this->dateTime(),
            '_status' => $this->integer(),
            'date_created' => $this->dateTime(),
            'created_by' => $this->integer(),
            'date_modified' => $this->dateTime(),
            'modified_by' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_blog');
    }
}
