<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_property`.
 */
class m160804_202434_create_re_property extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_property', [
            'id' => $this->primaryKey(),
            'property_name' => $this->string(200),
            'property_desc' => $this->text(),
            'property_location' => $this->text(),
            'property_type' => $this->integer(),
            'management_id' => $this->integer(200),
            'owner_id' => $this->integer(),
            'property_video_url' => $this->text(),
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
        $this->dropTable('re_property');
    }
}
