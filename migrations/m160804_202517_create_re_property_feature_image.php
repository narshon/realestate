<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_property_feature_image`.
 */
class m160804_202517_create_re_property_feature_image extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_property_feature_image', [
            'id' => $this->primaryKey(),
            'fk_property_feature_id' => $this->integer(),
            'image_url' => $this->text(),
            'image_title' => $this->string(200),
            'image_caption' => $this->text(), 
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
        $this->dropTable('re_property_feature_image');
    }
}
