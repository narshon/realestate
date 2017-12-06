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
 * @property integer $month
 * @property integer $year
 * @property string $pay_rent_due
 * @property double $balance_due
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
	    [['fk_occupancy_id', 'month', 'year', '_status','fk_source'], 'required'],
            [['fk_occupancy_id', 'month', 'year', '_status', 'created_by', 'modified_by'], 'integer'],
            [[ 'date_created', 'date_modified','date_paid','receipt_no','cheque_no','details','account_type'], 'safe'],
            [['pay_rent_due','balance_due','amount','amount_paid'], 'number'],
            [['fk_occupancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occupancy::className(), 'targetAttribute' => ['fk_occupancy_id' => 'id']],
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
            'pay_rent_due' => 'Pay Rent Due',
            'balance_due' => 'Balance Due',
            'date_paid' => 'Date Paid',
            '_status' => 'Status',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
            'fk_source' => 'Source'
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
    
    public function beforeSave($insert=''){
        parent::beforeSave($insert);
        
        \app\utilities\DataHelper::recordTimeStamp($this);
        
        
        if($this->hasErrors()){
            return false;
        }
        else{
            return true;
        }
    }
    
    public function receivePay(){
        if($this->amount_paid > 0){ //ensure that we have actually received some cash.
            //get all pending bills
            $bills = new \yii\db\Query();
            $bills->from('re_occupancy_rent');
            $bills->andFilterWhere(['=', 'fk_occupancy_id', $this->fk_occupancy_id]);
             $bills->andFilterWhere(['<', '_status', 3]); //getting all records where status is 1 and 2.
             $bills->all();
            if($bills){
                $count = count($bills); $i = 0;
                if($count > 0){
                    foreach($bills as $bill){
                        if($this->amount_paid > 0){ //check that we still have money for the next transaction.

                        //how much money do I need to top up here?
                        $balance_needed = $bill->amount - $bill->amount_paid;

                        if($balance_needed <= $this->amount_paid){ //if what we need for this bill is less than or equal to what we have
                            //update this  bill and send to journal.
                            $bill->amount_paid = $bill->amount_paid + $balance_needed;
                            $bill->date_paid = $this->date_paid;
                            $bill->_status = 4; //PAID EQUAL
                            if($bill->save(false)){
                               $this->postJournal($bill, $balance_needed);
                            }
                        }
                        else{  //balance needed is more than what we have received.
                            //update this  bill and send to journal.
                            $bill->amount_paid = $bill->amount_paid + $this->amount_paid;
                            $bill->date_paid = $this->date_paid;
                            $bill->_status = 2; //PAID LESS
                            if($bill->save(false)){
                               $this->postJournal($bill, $this->amount_paid);
                            }
                        }

                        //take it from received amount
                        $this->amount_paid = $this->amount_paid - $balance_needed;


                        }

                       $i++;
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
        $journal->transacted_by = Yii::app()->user->identity->id;
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
        $dh = new \app\utilities\DataHelper();
        $url = \yii\helpers\Url::to(['occupancy-rent/printreceipt','id'=>$this->id]);
        
        if($status == 1){
          return  Html::a("PENDING", ['#'], ['class' => 'btn btn-danger btn-sm' ,'onclick'=>"return false;"]);
          
        }
        elseif($status == 2){
            
          //  return  Html::a("PAID LESS", ['#'], ['class' => 'btn btn-danger btn-sm','onclick'=>"return false;"]).$receipt;
            return $dh->getModalButton(new \app\models\OccupancyRent, 'occupancy-rent/printreceipt', 'Receipt', 'btn btn-danger btn-sm','PAID LESS',$url);
        }
        elseif($status == 3){
            return $dh->getModalButton(new \app\models\OccupancyRent, 'occupancy-rent/printreceipt', 'Receipt', 'btn btn-success btn-sm','PAID MORE',$url);
        }
         elseif($status == 4){
            return $dh->getModalButton(new \app\models\OccupancyRent, 'occupancy-rent/printreceipt', 'Receipt', 'btn btn-success btn-sm','PAID',$url);
        }
    }
    
    public function getPayAccount(){
        $account = Journal::find()->where(['fk_occupancy_rent'=>$this->id])->orderBy("id Desc")->one();
        if($account){
            return $account->accountType->account_name;
        }
    }
}
