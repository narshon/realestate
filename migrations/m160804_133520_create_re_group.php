<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_group`.
 */
class m160804_133520_create_re_group extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_group', [
            'id' => $this->primaryKey(),
            'group_name' => $this->string(200),
            '_status' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_group');
    }
}
