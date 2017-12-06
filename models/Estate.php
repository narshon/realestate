<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_estate".
 *
 * @property integer $id
 * @property integer $fk_sub_location
 * @property string $estate_name
 * @property string $estate_desc
 * @property string $estate_review
 * @property string $estate_media
 * @property string $date_created
 * @property string $date_modified
 * @property integer $created_by
 * @property integer $modified_by
 *
 * @property SubLocation $fkSubLocation
 */
class Estate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_estate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_sub_location', 'created_by', 'modified_by'], 'integer'],
            [['estate_desc', 'estate_review', 'estate_media'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['estate_name'], 'string', 'max' => 200],
            [['fk_sub_location'], 'exist', 'skipOnError' => true, 'targetClass' => SubLocation::className(), 'targetAttribute' => ['fk_sub_location' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_sub_location' => 'Sub Location',
            'estate_name' => 'Estate Name',
            'estate_desc' => 'Estate Desc',
            'estate_review' => 'Estate Review',
            'estate_media' => 'Estate Media',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkSubLocation()
    {
        return $this->hasOne(SubLocation::className(), ['id' => 'fk_sub_location']);
    }
}
