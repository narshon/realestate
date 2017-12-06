<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_advert_feature`.
 */
class m160804_114001_create_re_advert_feature extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_advert_feature', [
            'id' => $this->primaryKey(),
            'fk_advert_id' => $this->integer(),
            'fk_feature_id' => $this->integer(),
            'feature_narration' => $this->text(),
            'image1' => $this->text(),
            'image2' => $this->text(),
            'image3' => $this->text(),
            '_status' => $this->integer(),
            'date_created' => $this->dateTime(),
            'date_modified' => $this->dateTime(),
            'created_by' => $this->integer(),
            'modified_by' => $this->integer(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('re_advert_feature');
    }
}
