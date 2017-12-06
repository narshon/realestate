<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_occupancy_rent`.
 */
class m160804_135957_create_re_occupancy_rent extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_occupancy_rent', [
            'id' => $this->primaryKey(),
            'fk_occupancy_id' => $this->integer(),
            'month' => $this->integer(),
            'year' => $this->integer(),
            'pay_rent_due' => $this->string(200),
            'balance_due' => $this->double(2),
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
        $this->dropTable('re_occupancy_rent');
    }
}
