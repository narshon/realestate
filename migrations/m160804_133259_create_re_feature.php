<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_feature`.
 */
class m160804_133259_create_re_feature extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_feature', [
            'id' => $this->primaryKey(),
            'feature_name' => $this->string(200),
            'feature_desc' => $this->text(),
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
        $this->dropTable('re_feature');
    }
}
