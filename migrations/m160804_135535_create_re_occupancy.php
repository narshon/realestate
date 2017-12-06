<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_occupancy`.
 */
class m160804_135535_create_re_occupancy extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_occupancy', [
            'id' => $this->primaryKey(),
            'fk_property_id' => $this->integer(),
            'fk_sublet_id' => $this->integer(),
            'fk_tenant_id' => $this->integer(),
            'start_date' => $this->date(),
            'end_date' => $this->date(),
            'notes' => $this->text(),
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
        $this->dropTable('re_occupancy');
    }
}
