<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%disbursements}}".
 *
 * @property integer $id
 * @property integer $fk_occupancy_rent
 * @property integer $fk_landlord
 * @property integer $batch_id
 * @property double $amount
 * @property string $entry_date
 * @property string $created_on
 * @property integer $created_by
 * @property integer $_status
 *
 * @property SysUsers $fkLandlord
 * @property OccupancyRent $fkOccupancyRent
 */
class Disbursements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%disbursements}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_occupancy_rent', 'amount', 'entry_date'], 'required'],
            [['fk_occupancy_rent', 'fk_landlord', 'batch_id', 'created_by', '_status'], 'integer'],
            [['amount'], 'number'],
            [['entry_date', 'created_on'], 'safe'],
            [['fk_landlord'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['fk_landlord' => 'id']],
            [['fk_occupancy_rent'], 'exist', 'skipOnError' => true, 'targetClass' => OccupancyRent::className(), 'targetAttribute' => ['fk_occupancy_rent' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_occupancy_rent' => 'Fk Occupancy Rent',
            'fk_landlord' => 'Fk Landlord',
            'batch_id' => 'Batch ID',
            'amount' => 'Amount',
            'entry_date' => 'Entry Date',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            '_status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLandlord()
    {
        return $this->hasOne(Users::className(), ['id' => 'fk_landlord']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOccupancyRent()
    {
        return $this->hasOne(OccupancyRent::className(), ['id' => 'fk_occupancy_rent']);
    }
}
