<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_occupancy_term`.
 */
class m160804_140005_create_re_occupancy_term extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_occupancy_term', [
            'id' => $this->primaryKey(),
            'fk_occupancy_id' => $this->integer(),
            'fk_property_term_id' => $this->integer(),
            'date_signed' => $this->date(),
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
        $this->dropTable('re_occupancy_term');
    }
}
