<?php

use yii\db\Migration;

/**
 * Handles the creation for table `sys_users`.
 */
class m160804_195829_create_sys_users extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sys_users', [
            'id' => $this->primaryKey(),
            'fk_group_id' => $this->integer(),
            'fk_management_id' => $this->integer(),
            'username' => $this->string(50),
            'pass' => $this->string(50),
            'name1' => $this->string(200),
            'name2' => $this->string(200),
            'name3' => $this->string(200),
            'age' => $this->integer(),
            
            'email' => $this->string(500),
            'phone' => $this->integer()->unique(),
            'address' => $this->text(),
            'date_added' => $this->dateTime(),
            'gender' => $this->string(2),
            'color_code' => $this->string(100),
            'icon_id' => $this->string(11),
            
        ]);
        
        // creates index for column `category_id`
        $this->createIndex(
            'idx-group-fk_group_id',
            'sys_users',
            'fk_group_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-group-fk_group_id',
            'sys_users',
            'fk_group_id',
            're_group',
            'id',
            'CASCADE'
        );
        
        // creates index for column `category_id`
        $this->createIndex(
            'idx-re_management-fk_management_id',
            'sys_users',
            'fk_management_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-re_management-fk_management_id',
            'sys_users',
            'fk_management_id',
            're_management',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sys_users');
    }
}
