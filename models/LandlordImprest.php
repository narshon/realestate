<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%landlord_imprest}}".
 *
 * @property integer $id
 * @property integer $fk_landlord
 * @property double $amount
 * @property string $entry_date
 * @property string $created_on
 * @property integer $created_by
 * @property integer $_status
  * @property string $imprest_type
  * @property integer $settlement_id
 *
 * @property SysUsers $fkLandlord
 */
class LandlordImprest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%landlord_imprest}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_landlord', 'created_by', '_status','settlement_id'], 'integer'],
            [['amount', 'entry_date'], 'required'],
            [['amount'], 'number'],
            [['entry_date', 'created_on','imprest_type'], 'safe'],
            [['fk_landlord'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['fk_landlord' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_landlord' => 'Fk Landlord',
            'amount' => 'Amount',
            'entry_date' => 'Entry Date',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            '_status' => 'Status',
            'settlement_id'=>'Settlement ID',
            'imprest_type'=>'Imprest Type'
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLandlord()
    {
        return $this->hasOne(Users::className(), ['id' => 'fk_landlord']);
    }
}
