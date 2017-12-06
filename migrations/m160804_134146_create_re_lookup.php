<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_lookup`.
 */
class m160804_134146_create_re_lookup extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_lookup', [
            'id' => $this->primaryKey(),
            '_key' => $this->string(200),
            '_value' => $this->text(),
            'category' => $this->integer(),
            '_order' => $this->integer(),
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
        $this->dropTable('re_lookup');
    }
}
