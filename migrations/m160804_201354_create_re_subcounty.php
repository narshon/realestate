<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_subcounty`.
 */
class m160804_201354_create_re_subcounty extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_subcounty', [
            'id' => $this->primaryKey(),
            'fk_county' => $this->integer(),
            'subcounty_name' => $this->string(200),
            'subcounty_desc' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_subcounty');
    }
}
