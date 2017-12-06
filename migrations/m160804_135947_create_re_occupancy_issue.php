<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_occupancy_issue`.
 */
class m160804_135947_create_re_occupancy_issue extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_occupancy_issue', [
            'id' => $this->primaryKey(),
            'fk_occupancy_id' => $this->integer(),
            'fk_related_term' => $this->integer(),
            'issue_type' => $this->integer(),
            'title' => $this->string(200),
            'desc' => $this->text(),
            'status_remarks' => $this->text(),
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
        $this->dropTable('re_occupancy_issue');
    }
}
