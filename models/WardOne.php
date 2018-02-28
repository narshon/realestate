<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ward_one".
 *
 * @property integer $id
 * @property integer $fk_subcounty
 * @property string $ward_name
 * @property string $ward_desc
 * @property string $ward_lat
 * @property string $ward_long
 *
 * @property Location[] $locations
 * @property Subcounty $fkSubcounty
 */
class WardOne extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_ward_one';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_subcounty'], 'integer'],
            [['ward_desc'], 'string'],
            [['ward_name'], 'string', 'max' => 200],
            [['ward_lat', 'ward_long'], 'string', 'max' => 10],
            [['fk_subcounty'], 'exist', 'skipOnError' => true, 'targetClass' => Subcounty::className(), 'targetAttribute' => ['fk_subcounty' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_subcounty' => 'Fk Subcounty',
            'ward_name' => 'Ward Name',
            'ward_desc' => 'Ward Desc',
            'ward_lat' => 'Ward Lat',
            'ward_long' => 'Ward Long',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['fk_ward' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkSubcounty()
    {
        return $this->hasOne(Subcounty::className(), ['id' => 'fk_subcounty']);
    }
}
