<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_occupancy_payments_mapping".
 *
 * @property integer $id
 * @property integer $fk_occupancy_payment
 * @property integer $fk_occupancy_rent
 * @property double $amount
 * @property string $type
 *
 * @property OccupancyPayments $fkOccupancyPayment
 * @property OccupancyRent $fkOccupancyRent
 */
class OccupancyPaymentsMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy_payments_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_occupancy_payment', 'fk_occupancy_rent', 'amount', 'type'], 'required'],
            [['fk_occupancy_payment', 'fk_occupancy_rent'], 'integer'],
            [['amount'], 'number'],
            [['type'], 'string'],
            [['fk_occupancy_payment'], 'exist', 'skipOnError' => true, 'targetClass' => OccupancyPayments::className(), 'targetAttribute' => ['fk_occupancy_payment' => 'id']],
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
            'fk_occupancy_payment' => 'Fk Occupancy Payment',
            'fk_occupancy_rent' => 'Fk Occupancy Rent',
            'amount' => 'Amount',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOccupancyPayment()
    {
        return $this->hasOne(OccupancyPayments::className(), ['id' => 'fk_occupancy_payment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOccupancyRent()
    {
        return $this->hasOne(OccupancyRent::className(), ['id' => 'fk_occupancy_rent']);
    }
    
    public static function getBillTotalPayments($fk_occupancy_rent){
        $total = 0;
        $payments = Self::find()->where(['fk_occupancy_rent'=>$fk_occupancy_rent])->all();
        if($payments){ 
            foreach($payments as $payment){
                if($payment->type=="complete"){
                    return $payment->amount;
                }
                else{
                    $total += $payment->amount;
                }
            }
        }
        
        return $total;
    }
}
