<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_preference`.
 */
class m160804_201936_create_re_preference extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_preference', [
            'id' => $this->primaryKey(),
            'fk_feature' => $this->integer(),
            'preference_title' => $this->string(200),
            'preference_desc' => $this->text(),
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
        $this->dropTable('re_preference');
    }
}
