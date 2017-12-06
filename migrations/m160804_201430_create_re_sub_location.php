<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_sub_location`.
 */
class m160804_201430_create_re_sub_location extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_sub_location', [
            'id' => $this->primaryKey(),
            'fk_location' => $this->integer(),
            'sub_loc_name' => $this->string(200),
            'sub_loc_desc' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_sub_location');
    }
}
