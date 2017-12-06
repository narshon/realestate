<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_property_term`.
 */
class m160804_202550_create_re_property_term extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_property_term', [
            'id' => $this->primaryKey(),
            'fk_property_id' => $this->integer(),
            'fk_term_id'=> $this->integer(),
            'term_title'=> $this->string(200),
            'term_title'=> $this->string(200),
            'term_narration'=> $this->text(),
            'action_handler'=> $this->string(200),
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
        $this->dropTable('re_property_term');
    }
}
