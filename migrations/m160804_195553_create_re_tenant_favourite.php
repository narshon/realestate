<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tenant_favourite`.
 */
class m160804_195553_create_re_tenant_favourite extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_tenant_favourite', [
            'id' => $this->primaryKey(),
            'fk_property_id' => $this->integer(),
            'fk_tenant_id' => $this->integer(),
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
        $this->dropTable('tenant_favourite');
    }
}
