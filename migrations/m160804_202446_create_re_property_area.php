<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_property_area`.
 */
class m160804_202446_create_re_property_area extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_property_area', [
            'id' => $this->primaryKey(),
            'fk_property_id' => $this->integer(),
            'fk_sub_location_id' => $this->integer(),
            'area_desc' => $this->text(),
            'area_name' => $this->string(200),
            'fk_estate_id' => $this->integer(200),
            
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
        $this->dropTable('re_property_area');
    }
}
