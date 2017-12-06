<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_county".
 *
 * @property integer $id
 * @property string $county_name
 * @property string $county_desc
 *
 * @property Subcounty[] $subcounties
 */
class County extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_county';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['county_name'], 'required'],
            [['county_desc'], 'string'],
            [['county_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'county_name' => 'County Name',
            'county_desc' => 'County Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcounties()
    {
        return $this->hasMany(Subcounty::className(), ['fk_county' => 'id']);
    }
}
