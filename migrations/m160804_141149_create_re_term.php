<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_term`.
 */
class m160804_141149_create_re_term extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_term', [
            'id' => $this->primaryKey(),
            'term_type' => $this->integer(),
            'term_name' => $this->string(200),
            'term_desc' => $this->text(),
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
        $this->dropTable('re_term');
    }
}
