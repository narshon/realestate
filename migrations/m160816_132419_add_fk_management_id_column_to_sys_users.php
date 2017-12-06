<?php

use yii\db\Migration;

/**
 * Handles adding fk_management_id_column to table `sys_users`.
 */
class m160816_132419_add_fk_management_id_column_to_sys_users extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sys_users', 'position', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sys_users', 'position');
    }
}
