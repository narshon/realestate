<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_property_sublet`.
 */
class m160804_202532_create_re_property_sublet extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_property_sublet', [
            'id' => $this->primaryKey(),
            'fk_property_id' => $this->integer(),
            'sublet_name'=> $this->string(200),
            'sublet_desc'=> $this->text(),
            
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
        $this->dropTable('re_property_sublet');
    }
}
