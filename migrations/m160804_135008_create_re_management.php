<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_management`.
 */
class m160804_135008_create_re_management extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_management', [
            'id' => $this->primaryKey(),
            'fk_user_id' => $this->integer(),
            'management_type' => $this->integer(),
            'management_name' => $this->string(200),
            'location' => $this->text(),
            'address' => $this->text(),
            'profile_desc' => $this->text(),
            'featured_property' => $this->integer(),
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
        $this->dropTable('re_management');
    }
}
