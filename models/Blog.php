<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_blog".
 *
 * @property integer $id
 * @property integer $fk_user_id
 * @property string $blog_title
 * @property string $blog_post
 * @property string $posted_date
 * @property integer $_status
 * @property string $date_created
 * @property string $date_modified
 * @property integer $modified_by
 * @property integer $created_by
 *
 * @property SysUsers $fkUser
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_user_id', '_status', 'modified_by', 'created_by'], 'integer'],
            [['blog_title', 'blog_post'], 'string'],
            [['posted_date', 'date_created', 'date_modified'], 'safe'],
            [['fk_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => SysUsers::className(), 'targetAttribute' => ['fk_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_user_id' => 'Fk User ID',
            'blog_title' => 'Blog Title',
            'blog_post' => 'Blog Post',
            'posted_date' => 'Posted Date',
            '_status' => 'Status',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(SysUsers::className(), ['id' => 'fk_user_id']);
    }
}
