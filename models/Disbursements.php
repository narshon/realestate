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
    public $payments_advance;
    public $payments_advance_ids;
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
            [['amount','payments_advance'], 'number'],
            [['entry_date', 'created_on','payments_pool','payments_advance_ids'], 'safe'],
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
        if($insert){
            //update the books of accounts, we're going to Debit disbursement account and credit accounts payable. Compare raising a bill in occupancy.
            $this->updateAccounts();
            return parent::afterSave($insert, $changedAttributes);
        }
    }
    
    public function updateAccounts()
    {
        $accountmap = AccountMap::findAll(['fk_term' => Term::getDisbursementTermID()]);
        if(is_array($accountmap)) {
            foreach($accountmap as $account) {
                AccountEntries::postTransaction($account->fk_account_chart, $account->transaction_type, $this->amount, $this->entry_date,$this->id,$this->className());
            }
        }
        
        return true;
    }
    
    public static function raise($occupant, $rentbill,$month, $year){
        //get amount to be disbursed
        $propertyTerm = PropertyTerm::find()->where(['fk_term_id'=>Term::getCommissionTermID(),'fk_property_id'=>$occupant->fk_property_id,'_status'=>1])->one();
        if($propertyTerm){
            $percentage = $propertyTerm->term_value;
            $amount = ($occupant->getBillAmount(Term::getRentTermID()) * (100-$percentage) / 100);

        }
        else{
            $percentage = 80; //defaults to 20%.
            $amount = ($occupant->getBillAmount(Term::getRentTermID()) * $percentage / 100);
        }
        $disburse = New Disbursements();
        $disburse->fk_occupancy_rent = $rentbill->id;
        $disburse->fk_landlord = $occupant->fkProperty->owner_id;
        $disburse->amount = $amount;
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
                $key = $bill->id.'_'.$bill->amount;
                $list[$key] = [
                    'content' =>  $bill->fkOccupancyRent->fkOccupancy->fkTenant->getNames().' - '.$bill->fkOccupancyRent->fkSource->source_name . ' - ' . $bill->amount. ' ('. $bill->year . '/' . $bill->month .')',
                ];
            }
        }
        return $list;
    }
    
    public static function clearBills($bills, $status)
    {
        foreach($bills as $bill) {
            if(($model = Disbursements::findOne($bill)) !== null) {
                $model->_status = $status;
                $model->save(false);
            }
        }
    }
    
    public function getPaymentAdvances($owner_id){
        $advance_ids = '';
        $advance_amount = 0;
        $advances = LandlordImprest::find()->where(['fk_landlord'=>$owner_id,'imprest_type'=>'Advance','_status'=>0])->all();
        if($advances){
            foreach($advances as $advance){
                $advance_ids .= $advance->id.',';
                $advance_amount += $advance->amount;
            }
           $advance_ids = substr($advance_ids, 0, -1);
        }
        
        $this->payments_advance = $advance_amount;
        $this->payments_advance_ids = $advance_ids;  //removes trailing commas.
    }
    
    public function getTenantName(){
        if(isset($this->fkOccupancyRent)){
            return $this->fkOccupancyRent->fkOccupancy->fkUsers->getNames();
        }
        else{
            return "";
        }
    }
    
    public function getPaidByTenantAmount(){
        if(isset($this->fkOccupancyRent)){
            $billed_amount = $this->fkOccupancyRent->amount;
            $check_paid = OccupancyPaymentsMapping::find()->where(['fk_occupancy_rent'=>$this->fk_occupancy_rent])->one();
            if($check_paid){
                return $check_paid->amount;
            }
        }
        
        return '';
        
    }
    
    public function getPaidByAgentAmount(){
        if(isset($this->fkOccupancyRent)){
            $billed_amount = $this->fkOccupancyRent->amount;
            $check_paid = OccupancyPaymentsMapping::find()->where(['fk_occupancy_rent'=>$this->fk_occupancy_rent])->one();
            if(!$check_paid){
                return $billed_amount;
            }
        }
        
        return '';
    }
    
    public function getTotalPaid(){
        $by_tenant = (float)$this->getPaidByTenantAmount();
        $by_agent = (float)$this->getPaidByAgentAmount();
        
        return $by_tenant + $by_agent;
    }
    
    public function getTotalPayable($cleared_bills, $payments_advance){
        //get total cleared bills.
        $total_bills = 0;
        $cleared_array = explode(",", $cleared_bills);
        if(is_array($cleared_array)){
         foreach($cleared_array as $bill){
             $bill_array = explode('_',$bill);
             $bill_id = $bill_array[0];
             $disbursement = \app\models\Disbursements::find()->where(['id'=>$bill_id])->one();
             if($disbursement){
                 $total_bills += $disbursement->getTotalPaid();
             }
         }
       }
       
       //total amount payable
       return $total_bills - $payments_advance;
    }
    
    public function settleDisbursements($owner_id, $cleared_bills, $advance_ids, $total_advance){
        //get total payable
        $total_amount = $this->getTotalPayable($cleared_bills, $total_advance);
        //raise this imprest
        $imprest = new LandlordImprest();
        $imprest->fk_landlord = $owner_id;
        $imprest->imprest_type = "Disbursement";
        $imprest->amount = $total_amount;
        $imprest->entry_date = date("Y-m-d");
        $imprest->created_on = date("Y-m-d H:i:s");
        $imprest->created_by = Yii::$app->user->identity->id;
        $imprest->_status = 1;
        if($imprest->save(false)){
            //update settled bills
            $cleared_array = explode(",", $cleared_bills);
            if(is_array($cleared_array)){
                foreach($cleared_array as $bill){
                    $bill_array = explode('_',$bill);
                    $bill_id = $bill_array[0];
                    $disbursement = Self::find()->where(['id'=>$bill_id])->one();
                    if($disbursement){
                        $disbursement->batch_id = $imprest->id;
                        $disbursement->_status = 2; //paid
                        $disbursement->save(false);
                    }

                }
            }
            //update imprest advances
            $advance_array = explode(",", $advance_ids);
            if(is_array($advance_array)){
                foreach($advance_array as $advance){
                    Yii::$app->db->createCommand()->update('re_landlord_imprest', ['settlement_id' => $imprest->id,'_status'=>1], "id = $advance")->execute();
                    
                }
            }
        }
        
        
         return "success";
    }
    
    
}
