<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_estate`.
 */
class m160804_132519_create_re_estate extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_estate', [
            'id' => $this->primaryKey(),
            'fk_sub_location' => $this->integer(),
            'estate_name' => $this->string(200),
            'estate_desc' => $this->text(),
            'estate_review' => $this->text(),
            'estate_media' => $this->text(),
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
        $this->dropTable('re_estate');
    }
}
