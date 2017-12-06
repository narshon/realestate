<?php

namespace app\models;

use Yii;
use app\models\AccountsTransaction;
use app\models\Source;
use yii\helpers\Url;
use yii\bootstrap\Button;
use app\utilities\DataHelper;



/**
 * This is the model class for table "journal".
 *
 * @property int $id
 * @property string $date
 * @property string $receipt_invoice_no
 *@property string $transaction_category
 *@property integer $transaction_type
 *@property string $fk_user
 *@property integer $fk_occupancy_rent
 * @property string $cheque_no
 * @property string $details
 * @property string $transacted_by
 * @property string $date_created
 * @property string $created_by
 * @property string $date_modified
 * @property string $modified_by
 *
 * @property Source[] $transactionType
 * @property AccountsTransaction[] $accountsTransactions
 */
class Journal extends \yii\db\ActiveRecord
{
    public $funds_from;
    public $funds_to;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_journal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['transaction_type','account_type','amount','date'],'required'],
			[['transaction_type','fk_occupancy_rent','fk_user','account_type','post_status'],'integer'],
            [['date', 'date_created', 'date_modified','amount'], 'safe'],
            [['details'], 'string'],
            [['receipt_invoice_no','cheque_no', 'transacted_by', 'created_by', 'modified_by'], 'string', 'max' => 50],
        ];
    }
    public function beforeSave($insert = ""){


            if($this->isNewRecord){
                    //$this->date_assigned = date("Y-m-d");
                    //$this->assigned_by = Yii::$app->user->identity->id;
                    $this->date_created = date("Y-m-d H:i:s");
                    $this->created_by = Yii::$app->user->identity->id;

            }
            else{
                    $this->date_modified = date("Y-m-d H:i:s");
                    $this->modified_by = Yii::$app->user->identity->id;
            }
           $this->date = date("Y-m-d", strtotime($this->date));

            if($this->hasErrors()){
                    return false;
            }
            else{
                    return true;
            }
    }
	
    public function afterFind(){

            $this->date = date("d-m-Y", strtotime($this->date));
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        //check if we have already posted.
        //post this entry to accountTransactions table.
            $accountTransaction = new AccountsTransaction();
            if($accountTransaction->processTransaction($this)){
               
                //All is well. update post status
               
                Journal::updateAll(['post_status'=>1],"id = $this->id");
            }
            else{
                Journal::updateAll(['post_status'=>0],"id = $this->id");
            }
       
        
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
	    'fk_occupancy_rent' => 'Occupancy Bill',
	    'fk_user' => 'fk_user',
            'receipt_invoice_no' => 'Receipt/Invoice  No',
	    'transaction_category' => 'Transaction Category',
	    'transaction_type' => 'Transaction Type',
            'cheque_no' => 'Cheque No',
            'details' => 'Details',
            'transacted_by' => 'Transacted By',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountsTransactions()
    {
        return $this->hasMany(AccountsTransaction::className(), ['fk_journal' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionType()
    {
        return $this->hasOne(Source::className(), ['id' => 'transaction_type']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountType()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'account_type']);
    }
	
	public function getJournalOptions(){
		
		$all = Journal::find()->all();
		$return = [];
		if($all)
		{
			foreach($all as $model){
				$return[$model->id] = $model->transaction_type;
			}
		}
		
		return $return;
	}
	
	public static function getStatusOptions(){
	 return [
                1 => 'Complete',
                0 => 'Pending'
			];
	}
        
        public function getStatus(){
            if($this->post_status == 0){
                return "Pending";
            }
            if($this->post_status == 1){
                return "Complete";
            }
        }
	
        
     public static function showButtons(){
            $journal = Url::to(['journal/index']);
            $accounts = Url::to(['accounts/index']);
            $source = Url::to(['source/index']);
            $transaction = Url::to(['accounts-transaction/index']);
            $dh = new DataHelper();
            $url = Url::to(['journal/transfer']);  //'site/update-data'
            $button = $dh->getModalButton(new journal, '', 'Transfer Funds', 'btn btn-danger btn-create btn-new pull-right','Transfer Funds',$url);
            
            $return = '<ul class=" nav nav-pills nav-stacked">';
            $return .= $button;
            $return .= Button::widget(["label" => "Accounts Transactions", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$transaction')"]]);            
            $return .= Button::widget(["label" => "Accounts", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$accounts')"]]);
            $return .= Button::widget(["label" => "Source", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$source')"]]);
            $return .= Button::widget(["label" => "Journal", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$journal')"]]);
            $return .= '</ul>';
      
             return $return;
        }
        
        public function getSource(){
            if(isset($this->transactionType->source_name)){
                return $this->transactionType->source_name;
            }
            else{
                return '';
            }
        }
        public function getAccountName(){
            if(isset($this->accountType->account_name)){
                return $this->accountType->account_name;
            }
            else{
                return '';
            }
        }
         public function transferValidations(){
            if(trim($this->date) == ''){
                $this->addError('date', "Date cannot be blank");
            }
            if(trim($this->amount) == ''){
                $this->addError('amount', "Amount cannot be blank");
            }
            if(trim($this->funds_from) == ''){
                $this->addError('funds_from', "Funds source cannot be blank");
            }
            if(trim($this->funds_to) == ''){
                $this->addError('funds_to', "Funds destination cannot be blank");
            }
            if(trim($this->transacted_by) == ''){
                $this->addError('transacted_by', "Transacted by cannot be blank");
            }
            //check if we have enough funds to transfer.
            $accountTransaction = AccountsTransaction::find()->where(['fk_account'=>$this->funds_from])->orderBy("id desc")->one();
            if($accountTransaction){
                if($this->amount >= $accountTransaction->running_balance){
                    $this->addError('amount', "The account source has insuficient amount.");
                }
            }
            
            if($this->hasErrors()){
                return false;
            }
            else{
                return true;
            }
        }
	public function transfer(){
            //ready to transfer
            //withdraw from source
            if(Source::getWithdrawalSource()){
                $withdrawal = new Journal();
                $withdrawal->date = $this->date;
                $withdrawal->account_type  = $this->funds_from;
                $withdrawal->transaction_type = Source::getWithdrawalSource();
                $withdrawal->cheque_no = $this->cheque_no;
                $withdrawal->details = "Account Transfer Withdrawal";
                $withdrawal->transacted_by = $this->transacted_by;
                $withdrawal->amount = $this->amount;
                if($withdrawal->save(false)){
                    //let's deposit now
                    if(Source::getDepositSource()){
                        $deposit = new Journal();
                        $deposit->date = $this->date;
                        $deposit->account_type  = $this->funds_to;
                        $deposit->transaction_type = Source::getDepositSource();
                        $deposit->cheque_no = $this->cheque_no;
                        $deposit->details = "Account Transfer Deposit";
                        $deposit->transacted_by = $this->transacted_by;
                        $deposit->amount = $this->amount;
                        if($deposit->save(false)){
                            return true;
                        }
                    }
                    else{
                        $this->addError("funds_to","Deposit transaction type not found.");
                        return false;
                    }

                }
            
            }
            else{
                $this->addError("funds_from","Withdrawal transaction type not found.");
                return false;
            }
            
            //if we get here we have a problem.
            $this->addError("funds_from","Oops! An error occured when saving transactions.");
            return false;
            
        }
	
	

	
}
