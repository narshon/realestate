<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_property_feature`.
 */
class m160804_202505_create_re_property_feature extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_property_feature', [
            'id' => $this->primaryKey(),
            'fk_feature' => $this->integer(),
            'fk_property_id' => $this->integer(),
            'fk_sublet_id' => $this->integer(),
            'feature_narration' => $this->text(), 
            'feature_video_url' => $this->text(),
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
        $this->dropTable('re_property_feature');
    }
}
