<?php

use yii\db\Migration;

/**
 * Handles the creation for table `re_advert`.
 */
class m160804_111210_create_re_advert extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('re_advert', [
            'id' => $this->primaryKey(),
            'advert_name' => $this->string(200),
            'advert_desc' => $this->text(),
            'advert_owner_id' => $this->integer(),
            'advert_fee'=>$this->integer(),
            'start_date' => $this->dateTime(),
            'end_date' => $this->dateTime(),
            '_status' => $this->integer(),
            'image1' => $this->text(),
            'image2' => $this->text(),
            'image3' => $this->text(),
            'image4' => $this->text(),
            'image5' => $this->text(),
            'contact_details' => $this->text(),
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
        $this->dropTable('re_advert');
    }
}
