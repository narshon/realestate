<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_location`.
 */
class m160804_133926_create_re_location extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_location', [
            'id' => $this->primaryKey(),
            'fk_ward' => $this->integer(),
            'location_name' => $this->string(200),
            'location_desc' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_location');
    }
}
