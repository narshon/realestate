<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_ward`.
 */
class m160804_140956_create_re_ward extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_ward', [
            'id' => $this->primaryKey(),
            'fk_subcounty' => $this->integer(),
            'ward_name' => $this->string(200),
            'ward_desc' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_ward');
    }
}
