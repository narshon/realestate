<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_county`.
 */
class m160804_132327_create_re_county extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_county', [
            'id' => $this->primaryKey(),
            'county_desc' => $this->text(),
            'county_name' => $this->string(200),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_county');
    }
}
