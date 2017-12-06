<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_sub_location".
 *
 * @property integer $id
 * @property integer $fk_location
 * @property string $sub_loc_name
 * @property string $sub_loc_desc
 *
 * @property Location $fkLocation
 */
class SubLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_sub_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_location','sub_loc_name'], 'required'],
            [['fk_location'], 'integer'],
            [['sub_loc_desc'], 'string'],
            [['sub_loc_name'], 'string', 'max' => 200],
            [['fk_location'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['fk_location' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_location' => 'Location',
            'sub_loc_name' => 'Sublocation Name',
            'sub_loc_desc' => 'Sublocation Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'fk_location']);
    }
}
