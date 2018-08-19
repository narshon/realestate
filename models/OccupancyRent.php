<?php

namespace app\models;

use Yii;
use app\models\Journal;
use yii\bootstrap\Html;

/**
 * This is the model class for table "re_occupancy_rent".
 *
 * @property integer $id
 * @property integer $fk_occupancy_id
 * @property integer $fk_source
 * @property integer $fk_term
 * @property integer $month
 * @property integer $year
 * @property double $amount
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Occupancy $fkOccupancy
 * @property Source $fkSource
 */
class OccupancyRent extends \yii\db\ActiveRecord
{
    public $receipt_no;
    public $cheque_no;
    public $details;
    public $account_type;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy_rent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_occupancy_id', 'fk_term'], 'required'],
            [['fk_occupancy_id', 'fk_source', 'fk_term', 'month', 'year', '_status', 'created_by', 'modified_by'], 'integer'],
            [['amount'], 'number'],
            [['date_created', 'date_modified'], 'safe'],
            [['fk_occupancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occupancy::className(), 'targetAttribute' => ['fk_occupancy_id' => 'id']],
            [['fk_source'], 'exist', 'skipOnError' => true, 'targetClass' => Source::className(), 'targetAttribute' => ['fk_source' => 'id']],
            [['fk_term'], 'exist', 'skipOnError' => true, 'targetClass' => Term::className(), 'targetAttribute' => ['fk_term' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_occupancy_id' => 'Fk Occupancy ID',
            'month' => 'Month',
            'year' => 'Year',
            'amount' => 'Amount',
            '_status' => 'Status',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
            'fk_source' => 'Source',
            'fk_term' => 'Property Term'
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
    public function getFkSource()
    {
        return $this->hasOne(Source::className(), ['id' => 'fk_source']);
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTerm()
    {
        return $this->hasOne(Term::className(), ['id' => 'fk_term']);
    }
    
    public function getOccupancyName(){
        return $this->fkOccupancy->fkProperty->property_name.'_'.$this->fkOccupancy->fkSublet->sublet_name;
    }
    
    public static function getSearchQuery($searchModel, $tenant_id){
		$query = OccupancyRent::find()->where(['in', 'fk_occupancy_id', Self::getOccupancies($tenant_id)]);
		
		if($searchModel->id != ""){ echo "hhshshs"; exit(); 
			$query->andWhere(['=', 'id_', $searchModel->id]);
			
		}
		
		
		return $query;
	}
        
    public static function getOccupancies($tenant_id){
        $return = [];
        $occupancies = Occupancy::find()->where(['fk_user_id'=>$tenant_id])->all();
        if($occupancies){ 
            foreach($occupancies as $occupancy){
                $return[]=$occupancy->id;
            }
        }
        
        return $return;
    }
    public function beforeValidate() {
        //check if no duplicate bill
       // $this->validateBill();
        return parent::beforeValidate();
    }
    public function validateBill(){
        $checkExist = $this->find()->where(['month'=>$this->month, 'year'=>$this->year, 'fk_term'=>$this->fk_term,'fk_occupancy_id'=>$this->fk_occupancy_id])->one();
        if($checkExist){
            $this->addError("fk_term", "Bill already exist for the selected period.");
        }
        
    }
    public function beforeSave($insert='')
    {
        \app\utilities\DataHelper::recordTimeStamp($this);
        return parent::beforeSave($insert);
    }
    
    public function afterSave($insert, $changedAttributes) 
    {
       if($insert){
          $this->updateAccounts(); 
       }
        return parent::afterSave($insert, $changedAttributes);
    }
    
    public function updateAccounts()
    {
        $accountmap = AccountMap::findAll(['fk_term' => $this->fk_term]);
        if(is_array($accountmap)) {
            foreach($accountmap as $account) {
                AccountEntries::postTransaction($account->fk_account_chart, $account->transaction_type, $this->amount, $this->date_created, $this->id,$this->className());
            }
        }
    }
    
    public function receivePay(){
        if($this->amount_paid > 0){ //ensure that we have actually received some cash.
            //get all pending bills
            $command = OccupancyRent::find()
                ->andFilterWhere(['fk_occupancy_id' => $this->fk_occupancy_id])
                ->andFilterWhere(['<' , '_status', 3])
                ->orderBy([
                    'year' => SORT_ASC,
                    'month' => SORT_ASC,
                ]);
            $bills = $command->all();
            if ( is_array($bills) && count($bills) ) {
                foreach ($bills as $bill) {
                    if ($this->amount_paid > 0) { //check that we still have money for the next transaction.
                    //how much money do I need to top up here?
                    $balance_needed = $bill->amount - $bill->amount_paid;

                    if ($balance_needed <= $this->amount_paid) { //if what we need for this bill is less than or equal to what we have
                        //update this  bill and send to journal.
                        $bill->amount_paid = $bill->amount_paid + $balance_needed;
                        $bill->date_paid = $this->date_paid;
                        $bill->_status = 4; //PAID EQUAL
                        if($bill->save()){
                           $this->postJournal($bill, $balance_needed);
                        }
                    }
                    else{  //balance needed is more than what we have received.
                        //update this  bill and send to journal.
                        $bill->amount_paid = $bill->amount_paid + $this->amount_paid;
                        $bill->date_paid = $this->date_paid;
                        $bill->_status = 2; //PAID LESS
                        if($bill->save()){
                           $this->postJournal($bill, $this->amount_paid);
                        }
                    }

                    //take it from received amount
                    $this->amount_paid = $this->amount_paid - $balance_needed;


                    }
               }
                   
                   //check if we still have money left over after paying these bills. bundle this amount in the most recent bill. Record excess payment.
                    if($this->amount_paid > 0){
                        $excessbill = $this->find()->where(['fk_occupancy_id'=>$this->fk_occupancy_id])->orderBy("id DESC")->one();
                        if($excessbill){
                            //update this  bill and send to journal.
                            $excessbill->amount_paid = $excessbill->amount_paid + $this->amount_paid;
                            $excessbill->date_paid = $this->date_paid;
                            $excessbill->_status = 4; //PAID MORE
                            if($excessbill->save(false)){
                               $this->postJournal($excessbill, $this->amount_paid);
                            }
                        }
                    }
                
            }
            return true;
        }
        return false;
    }
    
    public function postJournal($occupancyRent, $posted_amount){
        $journal = new Journal();
        $journal->date = $this->date_paid;
        $journal->receipt_invoice_no = $this->receipt_no;
        $journal->fk_occupancy_rent = $occupancyRent->id;
        $journal->fk_user = $occupancyRent->fkOccupancy->fk_user_id;
        $journal->account_type = $this->account_type;
        $journal->transaction_type = $occupancyRent->fk_source;
        $journal->cheque_no = $this->cheque_no;
        $journal->details = $this->details;
        $journal->transacted_by = Yii::$app->user->identity->id;
        $journal->save(false);
        
    }
    
    public function calculatePayDue(){
       return ($this->amount - $this->amount_paid);
    }
    
    public function calculateBalance(){
        //get previous balance record.
        $prev = $this->getLatestBalance();
        //add pay rent due and return as the new balance.
        if($prev){
         return ($this->pay_rent_due + $prev->balance_due);
        }
        else{
            return $this->pay_rent_due;
        }
        
    }

    public function getLatestBalance() {
        $model = $this->find()->where(['fk_occupancy_id'=>$this->fk_occupancy_id])->orderBy('id desc')->one();
        if($model){
            return $model;
        }
        else
          return false;
    }
    
    public function getPayDue(){
        return ($this->amount - $this->amount_paid);
    }
    
    public function getBalanceDue(){
        //calculate balances of this occupancy. until this transaction only.
        $models = $this->find()->where(['fk_occupancy_id'=>$this->fk_occupancy_id])->all();
        if($models){
            $count = 0; $prev_bal = 0;
            foreach($models as $model){
                if($count == 0){
                    //no prev bal
                    $running_bal = $model->getPayDue();
                   
                }
                else{
                    $running_bal = $prev_bal + $model->getPayDue();
                }
                
                $prev_bal = $running_bal;
               
                
                if($model->id == $this->id){
                    return $running_bal;
                }
                
                $count++;
            }
        }
        
    }
    
    public function getStatus(){
        //get status
        $status = $this->_status;
        //get the lookup label for this key.
        $lookup = Lookup::find()->where(['_key'=>$status, 'category'=> LookupCategory::find()->where(['category_name'=>"Match Bills"])->one()->id])->one();
        if($lookup){
            return $lookup->_value;
        }
    }
    
    public function getPayAccount(){
        $account = Journal::find()->where(['fk_occupancy_rent'=>$this->id])->orderBy("id Desc")->one();
        if($account){
            return $account->accountType->account_name;
        }
    }
    
    public static function getUnsettledBillList($id)
    {
        $list = [];
        $bills = OccupancyRent::find()->where("(_status = 0 OR _status = 2) AND fk_occupancy_id = $id")->all();
        if(is_array($bills)) {
            foreach($bills as $bill) {
                //check if something was paid for this bill.
                $bal = $bill->checkBalance();
                if($bal < $bill->amount){
                    $key = $bill->id.'_'.$bal;
                    $name = $bill->fkTerm->term_name . ' - ' . $bill->amount. ' ('. $bill->year . '/' . $bill->month .')'."- Bal=".$bal;
                }
                else{
                    $key = $bill->id.'_'.$bill->amount;
                    $name = $bill->fkTerm->term_name . ' - ' . $bill->amount. ' ('. $bill->year . '/' . $bill->month .')';
                }
		
                
                $list[$key] = [
                    'content' =>  $name
                ];
            }
        }
        return $list;
    }
    
    public function getPeriod(){
        $month = "";
        
        switch($this->month):
          case 1:
                $month = "January";
             break;
          case 2:
                $month = "February";
             break;
         case 3:
                $month = "March";
             break;
         case 4:
                $month = "April";
             break;
         case 5:
                $month = "May";
             break;
         case 6:
                $month = "June";
             break;
         case 7:
                $month = "July";
             break;
         case 8:
                $month = "August";
             break;
         case 9:
                $month = "September";
             break;
         case 10:
                $month = "October";
             break;
         case 11:
                $month = "November";
             break;
         case 12:
                $month = "December";
             break;
          Default:
              $month = '';
              break;
        endswitch;
        
        return $month."/".$this->year;
        
    }
    
    public function getBillDetails()
    {
        return $this->fkTerm->term_name . ' (' . $this->month . ' / ' . $this->year . ')';
    }
    
    public function checkBalance(){
        $total_paid = OccupancyPaymentsMapping::getBillTotalPayments($this->id);
        
        return $this->amount - $total_paid;
    }
}
