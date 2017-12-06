<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_lookup_category`.
 */
class m160804_134448_create_re_lookup_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_lookup_category', [
            'id' => $this->primaryKey(),
            'category_name' => $this->string(200)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_lookup_category');
    }
}
