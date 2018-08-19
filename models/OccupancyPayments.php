<?php

namespace app\models;

use Yii;
use app\models\LookupCategory;
use app\models\Lookup;
use kartik\helpers\Html;

/**
 * This is the model class for table "re_occupancy_payments".
 *
 * @property integer $id
 * @property integer $fk_occupancy_id
 * @property double $amount
 * @property string $payment_date
 * @property integer $fk_receipt_id
 * @property integer $payment_method
 * @property integer $mode
 * @property integer $account
 * @property string $ref_no
 * @property integer $status
 * @property integer $created_by
 * @property string $created_on
 * @property integer $modified_by
 * @property string $modified_on
 *
 * @property Occupancy $fkOccupancy
 * @property Receipt $fkReceipt
 */
class OccupancyPayments extends \yii\db\ActiveRecord
{
    public $totalbilledamount;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy_payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_occupancy_id', 'amount', 'fk_receipt_id', 'payment_method', 'mode','account'], 'required'],
            [['fk_occupancy_id', 'fk_receipt_id', 'payment_method', 'status', 'created_by', 'modified_by','mode','account'], 'integer'],
            [['amount'], 'number'],
            [['payment_date', 'created_on', 'modified_on'], 'safe'],
            [['ref_no'], 'string', 'max' => 50],
            [['fk_occupancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occupancy::className(), 'targetAttribute' => ['fk_occupancy_id' => 'id']],
            [['fk_receipt_id'], 'exist', 'skipOnError' => true, 'targetClass' => Receipt::className(), 'targetAttribute' => ['fk_receipt_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_occupancy_id' => 'Occupancy',
            'amount' => 'Amount',
            'payment_date' => 'Payment Date',
            'fk_receipt_id' => 'Receipt',
            'payment_method' => 'Payment Method',
            'ref_no' => 'Ref No',
            'status' => 'Status',
            'created_by' => 'Received By',
            'created_on' => 'Created On',
            'modified_by' => 'Modified By',
            'modified_on' => 'Modified On',
            'mode'=>'Payment Mode',
            'account' => "Account"
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOccupancy()
    {
        return $this->hasOne(Occupancy::className(), ['id' => 'fk_occupancy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkReceipt()
    {
        return $this->hasOne(Receipt::className(), ['id' => 'fk_receipt_id']);
    }
    public function beforeValidate() {
        $class = \yii\helpers\StringHelper::basename(get_class($this));
        if(($recept_no = $this->generateReceipt()) !== null && $class == 'OccupancyPayments' && $this->isNewRecord ) {
                $this->fk_receipt_id = $recept_no;
                return parent::beforeValidate();
        } else {
            return false;
        }
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        if($this->isNewRecord) {
            $this->created_by = isset(\yii::$app->user->identity->id) ? \yii::$app->user->identity->id: 1;
            $this->created_on = date('Y-m-d');
            $this->payment_date = date('Y-m-d');
            //status is Paid by default
            $this->status = 1; //paid by default.
        } else {
            $this->modified_by = isset(\yii::$app->user->identity->id) ? \yii::$app->user->identity->id: 1;
            $this->modified_on = date('Y-m-d');
        }
        
        $this->validateAccount();
        
        if($this->hasErrors()){
            return false;
        }
        else{
            return true;
        }
        
    }
    private function generateReceipt()
    {
        $latest = Receipt::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->one();
        $model = new Receipt();
        $model->receipt_no = $latest !== null ? 'jnr'. (intval(substr($latest->receipt_no, 3)) + 1) :'jnr'. 1;
        $model->date_created = date('Y-m-d H:i:s');
        $model->created_by = isset(\yii::$app->user->identity->id) ? \yii::$app->user->identity->id: 1;
        if($model->save()) {
            return $model->id;
        } else {
            return null;
        }
    }
    
    public function postJournal()
    {
        $journal = new Journal();
        $journal->date = $this->payment_date;
        $journal->receipt_invoice_no = $this->fk_receipt_id;
        $journal->fk_occupancy_rent = $this->id;
        $journal->fk_user = $this->fkOccupancy->fk_user_id;
        $journal->account_type = $this->payment_method;
        //$journal->transaction_type = $occupancyRent->fk_source;
       // $journal->cheque_no = $this->cheque_no;
       //$journal->details = $this->details;
        $journal->transacted_by = Yii::$app->user->identity->id;
        $journal->save(false);
    }
	
	public function getPaymentMethod()
    {
		 $method = LookupCategory::find()->where(['category_name'=>'Payment Method'])->one();
		
        if($method){
			$methodtype = Lookup::find()->where(['_key'=>$this->payment_method, 'category'=>$method->id])->one();
           
				if($methodtype){
			return $methodtype->_value ;			
        }
    }
	}
	
    public function afterSave($insert, $changedAttributes) 
    {
        $accountmap = AccountMap::find()->where(['fk_term' => Term::getPaymentTermID($this->mode) , 'status'=> 1])->all();
        if(is_array($accountmap)) {
            foreach($accountmap as $account) {
                
                if($this->mode == 1 && $account->transaction_type == "debit"){
                    $ac_no = $this->account;
                }
                elseif($this->mode == 2 && $account->transaction_type == "credit"){
                    $ac_no = $this->account;
                }
                else{
                    $ac_no = $account->fk_account_chart;
                }
                
                AccountEntries::postTransaction($ac_no, $account->transaction_type, $this->amount, $this->payment_date, $this->id,$this->className());
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }
    
    public function matchRecords($bills, $allocate_bal)
    {
        $part_bal_key = 0;
        $part_bal = explode("_", $allocate_bal);
        if(isset($part_bal[0]) && $part_bal[0] > 0){
            $part_bal_key =  $part_bal[0];
        }
        if(isset($part_bal[1])){
            $part_bal_value =  $part_bal[1];
        }
        
        foreach($bills as $bill) {
	   $key = explode("_", $bill);
	    if($key){
		$bill = $key[0];
                $amount = $key[1];
	    }
            $model = new OccupancyPaymentsMapping();
            $model->fk_occupancy_payment = $this->id;
            $model->fk_occupancy_rent = $bill;
            if($bill == $part_bal_key){
                $model->type = 'partial';
                $model->amount = $part_bal_value;
            }
            else{
                $model->type = 'complete';
                $model->amount =  $amount;  // self::getBillAmount($bill);
            }
            
            
            if($model->save()){
                //*************** check if this bill was a Rent bill and raise commission transaction ***********************
                if($model->fkOccupancyRent->fkTerm->id == 1){
                    //yes this was rent. raise our commission.
                    //amount
                      //get property term for this commission
                      $occupancyRent = OccupancyRent::findone($bill);
                      if($occupancyRent){
                           $propertyTerm = PropertyTerm::find()->where(['fk_term_id'=>Term::getCommissionTermID(),'fk_property_id'=>$occupancyRent->fkOccupancy->fk_property_id,'_status'=>1])->one();
                           if($propertyTerm){
                               $percentage = $propertyTerm->term_value;
                               $amount = ($model->amount * $percentage / 100);
                               
                           }
                           else{
                               $percentage = 10; //defaults to 10%.
                               $amount = ($model->amount * $percentage / 100);
                           }
                            $accountmap = AccountMap::find()->where(['fk_term' => Term::getCommissionTermID() , 'status'=> 1])->all();
                            if(is_array($accountmap)) {
                                foreach($accountmap as $account) {
                                    AccountEntries::postTransaction($account->fk_account_chart, $account->transaction_type, $amount, $this->payment_date, $occupancyRent->id,$occupancyRent->className());
                                }
                            }
                      }
                     
                }
                
            }
        }
    }
    
    private static function getBillAmount($id)
    {
        if(($model = OccupancyRent::findOne($id)) !== null) {
            return $model->amount;
        }
    }
    
    public function getMatchedBillItems()
    {
        $ret = [];
        $matched = OccupancyPaymentsMapping::find()
            ->where(['fk_occupancy_payment' => $this->id])->all();
        if(count($matched) > 0) {
            return $matched;
        }
        else{
             return NULL;
        }
       
    }
    
    public function matchBills(){
        if($this->mode != 2){
            $print = ''; $match = '';
            //check if this payment has not been exhausted already
            $this->totalbilledamount = OccupancyPaymentsMapping::find()
                            ->where(['fk_occupancy_payment' => $this->id])
                            ->sum('amount');
            $this->totalbilledamount = ($this->totalbilledamount == null)? 0 : $this->totalbilledamount;

            if($this->totalbilledamount > 0){
                //this payment has matched bills. Present printing.
                $url = yii\helpers\Url::to(['occupancy-payments/print-receipt', 'id' => $this->id],true);
                $print = Html::a('<i class="glyphicon glyphicon-print"> _print</i>',$url, [
                              //  'type'=>'button',
                              //  'title'=>'Print Receipt', 
                                'class'=>'btn', 
                                'target'=>"_blank",
                            //    'value' => yii\helpers\Url::to(['occupancy-payments/print-receipt', 'id' => $this->id])
                                ]);
            }
            if($this->totalbilledamount < $this->amount){
                //present matching link here. Payment still has unallocated funds.
                $match = Html::button('<i class="glyphicon glyphicon-print"> _match</i>', [
                                'type'=>'button',
                                'title'=>'Match This Payment to bills', 
                                'class'=>'btn  showModalButton', 
                                'value' => yii\helpers\Url::to(['occupancy-payments/map', 'id' => $this->id])]);
            }

            return $print.$match;
        
        }
        else{
            return "";
        }
    
    }
    
    public function getPaymentPool(){
        //get total billed amount so far for this payment.
        $this->totalbilledamount = OccupancyPaymentsMapping::find()
                        ->where(['fk_occupancy_payment' => $this->id])
                        ->sum('amount');
        $this->totalbilledamount = ($this->totalbilledamount == null)? 0 : $this->totalbilledamount;
        //calculate pool.
        $pool = $this->amount - $this->totalbilledamount;
        
        return $pool;
    }
    
    public function validateAccount(){
        //check if on pay mode.
        if($this->mode == 2){ // pay mode
            $check = AccountChart::checkSufficientFunds($this->account, $this->amount);
            if($check){
                return true;
            }
            else{
                $this->addError('account', "Insufficient funds to make payment.");
                return false;
            }
        }
        else{
            return true;
        }
        
    }
    
    public function getAmountOfBillPaid($terms){
        $amount = 0;
        if(is_array($terms)){
            $term_condition = "fk_term IN (".implode(",", $terms).")";
        }
        else{
            $term_condition = "fk_term = $terms";
        }
        $mappings = OccupancyPaymentsMapping::find()->where(["fk_occupancy_payment"=>$this->id])->all();
        if($mappings){
            foreach($mappings as $map){
                $bill_id = $map->fk_occupancy_rent;
                $bill = OccupancyRent::find()->where("id = $bill_id AND $term_condition ")->one();
                if($bill){
                    $amount += $map->amount;
                }
            }
        }
        
        return $amount;
    }
    
    public function getTotalAmountOfBill($terms, $from, $to, $occupancy_id){
        $amount = 0;
        if(is_array($terms)){
            $term_condition = "fk_term IN (".implode(",", $terms).")";
        }
        else{
            $term_condition = "fk_term = $terms";
        }
        $payments = OccupancyPayments::find()->where("fk_occupancy_id = $occupancy_id AND (payment_date BETWEEN '$from' and '$to')")->all();
       // return $payments->createCommand()->getRawSql(); 
        if($payments){  
          foreach($payments as $payment){
            $mappings = OccupancyPaymentsMapping::find()->where(["fk_occupancy_payment"=>$payment->id])->all();
            if($mappings){
                foreach($mappings as $map){
                    $bill_id = $map->fk_occupancy_rent;
                    $bill = OccupancyRent::find()->where("id = $bill_id AND $term_condition ")->one();
                    if($bill){
                        $amount += $map->amount;
                    }
                }
            }  
          }
            
        }
        
        
        
        return $amount;
    }
     
}
