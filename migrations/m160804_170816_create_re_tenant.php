<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_tenant`.
 */
class m160804_170816_create_re_tenant extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_tenant', [
            'id' => $this->primaryKey(),
            'fk_user_id' => $this->integer(),
            'tenant_desc' => $this->text(),
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
        $this->dropTable('re_tenant');
    }
}
