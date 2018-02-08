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
    public $payments_pool;
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
            [['fk_occupancy_rent', 'fk_landlord', 'batch_id', 'created_by', '_status','month','year'], 'integer'],
            [['amount'], 'number'],
            [['entry_date', 'created_on','payments_pool'], 'safe'],
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
            'month' => 'Month',
            'year' => 'Year'
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
    
    public function afterSave($insert, $changedAttributes) {
        //update the books of accounts, we're going to Debit disbursement account and credit accounts payable. Compare raising a bill in occupancy.
        $this->updateAccounts();
        return parent::afterSave($insert, $changedAttributes);
    }
    
    public function updateAccounts()
    {
        $accountmap = AccountMap::findAll(['fk_term' => Term::getDisbursementTermID()]);
        if(is_array($accountmap)) {
            foreach($accountmap as $account) {
                AccountEntries::postTransaction($account->fk_account_chart, $account->transaction_type, $this->amount, $this->entry_date,$this->id,$this->className());
            }
        }
    }
    
    public static function raise($occupant, $rentbill,$month, $year){
        $disburse = New Disbursements();
        $disburse->fk_occupancy_rent = $rentbill->id;
        $disburse->fk_landlord = $occupant->fkProperty->owner_id;
        $disburse->amount = $occupant->getBillAmount(Term::getRentTermID());
        $disburse->month = $month;
        $disburse->year = $year;
        $disburse->entry_date = date("Y-m-d");
        $disburse->created_by = Yii::$app->user->identity->id;
        $disburse->created_on = date("Y-m-d H:i:s");
        $disburse->_status = 1;
        
        return $disburse->save();
    }
    
    public static function getUnsettledDisbursementList($id)
    {
        $list = [];
        $bills = Self::findAll(['_status' => 1, 'fk_landlord'=>$id]);
        if(is_array($bills)) {
            foreach($bills as $bill) {
                $list[$bill->id] = [
                    'content' =>  $bill->fkOccupancyRent->fkSource->source_name . ' - ' . $bill->amount. ' ('. $bill->year . '/' . $bill->month .')'
                ];
            }
        }
        return $list;
    }
    
    
}
