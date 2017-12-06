<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_property_sublet".
 *
 * @property integer $id
 * @property integer $fk_property_id
 * @property string $sublet_name
 * @property string $sublet_desc
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Occupancy[] $occupancies
 * @property PropertyFeature[] $propertyFeatures
 * @property Property $fkProperty
 */
class PropertySublet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_property_sublet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_property_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['sublet_desc'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['sublet_name'], 'string', 'max' => 200],
            [['fk_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['fk_property_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_property_id' => 'Fk Property ID',
            'sublet_name' => 'Sublet Name',
            'sublet_desc' => 'Sublet Desc',
            '_status' => 'Status',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancies()
    {
        return $this->hasMany(Occupancy::className(), ['fk_sublet_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatures()
    {
        return $this->hasMany(PropertyFeature::className(), ['fk_sublet_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'fk_property_id']);
    }
}
