<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_subcounty".
 *
 * @property integer $id
 * @property integer $fk_county
 * @property string $subcounty_name
 * @property string $subcounty_desc
 *
 * @property County $fkCounty
 * @property Ward[] $wards
 */
class Subcounty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_subcounty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_county','subcounty_name'], 'required'],
            [['fk_county'], 'integer'],
            [['subcounty_desc'], 'string'],
            [['subcounty_name'], 'string', 'max' => 200],
            [['fk_county'], 'exist', 'skipOnError' => true, 'targetClass' => County::className(), 'targetAttribute' => ['fk_county' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_county' => 'Fk County',
            'subcounty_name' => 'Subcounty Name',
            'subcounty_desc' => 'Subcounty Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCounty()
    {
        return $this->hasOne(County::className(), ['id' => 'fk_county']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWards()
    {
        return $this->hasMany(Ward::className(), ['fk_subcounty' => 'id']);
    }
}
