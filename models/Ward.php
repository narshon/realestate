<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_ward".
 *
 * @property integer $id
 * @property integer $fk_subcounty
 * @property string $ward_name
 * @property string $ward_desc
 *
 * @property Location[] $locations
 * @property Subcounty $fkSubcounty
 */
class Ward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_ward';
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
