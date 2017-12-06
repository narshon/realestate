<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tenant_preference`.
 */
class m160804_195241_create_re_tenant_preference extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_tenant_preference', [
            'id' => $this->primaryKey(),
            'fk_tenant_id' => $this->integer(),
            'fk_pref_id' => $this->integer(),
            'pref_notes'=> $this->text(),
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
        $this->dropTable('tenant_preference');
    }
}
