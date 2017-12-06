<?php

namespace app\models;

use Yii;
use app\models\Journal;
use app\utilities\DataHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "accounts_transaction".
 *
 * @property int $id
 * @property int $fk_journal
 * @property int $fk_account
 * @property int $fk_source
 * @property string $dr
 * @property string $cr
 * @property string $running_balance
 * @property string $details
 * @property string $date_created
 * @property string $created_by
 * @property string $date_modified
 * @property string $modified_by
 *
 * @property Journal $fkJournal
 * @property Source $fkSource
 * @property Accounts $fkAccount
 */
class AccountsTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_accounts_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
	    [['fk_journal', 'fk_account', 'fk_source'], 'required'],
            [['fk_journal', 'fk_account', 'fk_source','reconciled'], 'integer'],
            [['dr', 'cr', 'running_balance','reconciled_amount'], 'number'],
            [['details'], 'string'],
            [['date_created', 'date_modified','reconciled_date'], 'safe'],
            [['created_by', 'modified_by','reconciled_by'], 'string', 'max' => 100],
            [['fk_journal'], 'exist', 'skipOnError' => true, 'targetClass' => Journal::className(), 'targetAttribute' => ['fk_journal' => 'id']],
            [['fk_source'], 'exist', 'skipOnError' => true, 'targetClass' => Source::className(), 'targetAttribute' => ['fk_source' => 'id']],
            [['fk_account'], 'exist', 'skipOnError' => true, 'targetClass' => Accounts::className(), 'targetAttribute' => ['fk_account' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_journal' => 'Journal',
            'fk_account' => ' Account',
            'fk_source' => ' Source',
            'dr' => 'Dr',
            'cr' => 'Cr',
            'running_balance' => 'Running Balance',
            'details' => 'Details',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkJournal()
    {
        return $this->hasOne(Journal::className(), ['id' => 'fk_journal']);
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
    public function getFkAccount()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'fk_account']);
    }
	public function getAccountTransactionOptions(){
		
		$all = Source::find()->all();
		$return = [];
		if($all)
		{
			foreach($all as $model){
				$return[$model->id] = $model->transaction_category;
			}
		}
		
		return $return;
	}
        
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        if(isset($this->reconciled)){
            $this->reconciled_by = Yii::$app->user->identity->getNames();
            $this->reconciled_date = date("Y-m-d H:i:s");
        }
        
        if($this->hasErrors()){
            return false;
        }
        else{
            return true;
        }
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        $new_amount = "";
        //get the immediate previous reconciled transaction by reconciled_date
        $transaction = $this->find()->where("fk_account={$this->fk_account} AND id <> $this->id AND (reconciled=1 || reconciled=2)")->orderBy("reconciled_date DESC")->one();
        if($transaction){
            $prev_amount = $transaction->running_balance;
        }
        else{
            $prev_amount = 0;
        }
        
        $transaction_type = $this->fkSource->source_type;
        //do calculation if we have reconciled.
        if($this->reconciled == 1){
            
            if($transaction_type == "Expense"){
                $new_amount = $prev_amount - $this->fkJournal->amount;
            }
            if($transaction_type == "Income"){
                $new_amount = $prev_amount + $this->fkJournal->amount;
            }
            
        }
        else if($this->reconciled == 2){
            //we have overwritten original entry. 
            
               if($transaction_type == "Expense"){
                   $new_amount = $prev_amount - $this->reconciled_amount;
               }
               if($transaction_type == "Income"){
                   $new_amount = $prev_amount + $this->reconciled_amount;
               }
            
        }
        else{
            //Do nothing.
        }
        
        //check if we have new_amount to update running balance.
        if($new_amount != ""){
            AccountsTransaction::updateAll(['running_balance'=>$new_amount],"id = $this->id");
        }
        
    }

        public function processTransaction($journal){
        $this->fk_journal = $journal->id;
        $this->fk_account = $journal->account_type;
        $this->fk_source  = $journal->transaction_type;
        $source_type = Source::getSourceType($journal->transaction_type);
        if($source_type == "Expense"){
            $this->cr = $journal->amount;
        }
        if($source_type == "Income"){
            $this->dr = $journal->amount;
        }
        
       return $this->save(false);
    }
    
    public function getRunningBalance(){
        //check if this has been reconciled.
        if($this->reconciled == 1 || $this->reconciled == 2){
            //yes, we are good to go.
              return $this->running_balance;
            
        }
        else{
            //show reconciliation button.
            $dh = new DataHelper();
            $url = Url::to(['accounts-transaction/reconcile','id'=>$this->id]);  //'site/update-data'
            return $dh->getModalButton($this, 'accounts-transaction/reconcile', 'Account Transaction', 'btn btn-info btn-danger btn-new pull-right','Validate',$url);
        }
    }
	
	public function getAmount(){
		if($this->fkSource->source_type == "Expense"){
			return $this->cr;
		}
		else{
			return $this->dr;
		}
	}
        public static function generateTransactionsReportColumns(){
            $columns = [];
            $columns = self::getJournalColumns();
            $columns =  array_merge($columns, self::getBankColumns());
            $columns =  array_merge($columns, self::getIncomeColumns());
            $columns =  array_merge($columns, self::getExpensesColumns());
           // echo "<pre>";   print_r($columns);
            return $columns;
         
        }
        
        public static function getJournalColumns(){
            return [
                [
                    'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                    'attribute' => 'date',
                    'filter'=>true,
                    'header'=>'Date',
                    'value'=>function ($data) {
                                return isset($data->fkJournal->date)?$data->fkJournal->date:"";
                            },

                ],
                [
                    'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                    'attribute' => 'fk_receipt',
                    'filter'=>true,
                    'header'=>'Receipt/Invoice',
                    'value'=>function ($data) {
                                return isset($data->fkJournal->receipt_invoice_no)?$data->fkJournal->receipt_invoice_no:"";
                            },

                ],

                 [
                    'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                  //  'attribute' =>'cheque_no.',
                    'filter'=>true,
                    'header'=>'cheque no.',
                    'value'=>function ($data) {
                                return isset($data->fkJournal->cheque_no)?$data->fkJournal->cheque_no :"";
                            },

                ],

                [
                    'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                  //  'attribute' =>'details',
                    'filter'=>true,
                    'header'=>'Details',
                    'value'=>function ($data) {
                                return isset($data->fkJournal->details)?$data->fkJournal->details :"";
                            },

                  ]
                ];
        }
        
        public static function getBankColumns(){
            //get banks available from the accounts table
            $return = [];
            $accounts = Accounts::find()->all();
            if($accounts){
                foreach($accounts as $account){
                    //for each account, we have 3 columns. dr, cr, bl.
                    $i =0;
                    for($i=0; $i<3; $i++){
                        if($i == 0){
                         
                             $label = "Dr";
                             $return[] = [
                                        'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                                       // 'attribute' =>$label,
                                        'filter'=>true,
                                        'header'=>$label,
                                        'value'=>function ($data) use($account) {
                                                if($data->fk_account == $account->id)
                                                       return isset($data->dr)?$data->dr:"";
                                                },

                           ];
                        }
                         else if($i == 1){
                             $label = "Cr";
                             $return[] = [
                                        'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                                       // 'attribute' =>$label,
                                        'filter'=>true,
                                        'header'=>$label,
                                        'value'=>function ($data)use($account) {
                                                if($data->fk_account == $account->id)
                                                       return isset($data->cr)?$data->cr:"";
                                                },

                           ];
                         }
                         else if($i == 2){
                             $label = "Bl";
                             $return[] = [
                                        'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                                       // 'attribute' =>$label,
                                        'filter'=>true,
                                        'header'=>$label,
                                        'value'=>function ($data) use($account) {
                                                if($data->fk_account == $account->id)
                                                       return isset($data->running_balance)?$data->running_balance:"";
                                                },

                           ];
                         }
                        
                        
                    }
                    
                }
            }
         
            return $return;
        }
        
        public static function getIncomeColumns(){
            $return = [];
            $sources = Source::find()->where(['source_type'=>'Income'])->all();
            if($sources){
                foreach($sources as $source){
                    $label = $source->source_name;
                    $return[] = [
                               'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                              // 'attribute' =>$label,
                               'filter'=>true,
                               'header'=>$label,
                               'value'=>function ($data) use($source) {
                                       if($data->fk_source == $source->id){
                                           return $data->getAmount();                          
                                       }
                                              
                                    },

                  ];
                }
            }
           return $return;
        }
        
        public static function getExpensesColumns(){
            $return = [];
            $sources = Source::find()->where(['source_type'=>'Expense'])->all();
            if($sources){
                foreach($sources as $source){
                    $label = $source->source_name;
                    $return[] = [
                               'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                              // 'attribute' =>$label,
                               'filter'=>true,
                               'header'=>$label,
                               'value'=>function ($data) use($source) {
                                       if($data->fk_source == $source->id){
                                           return $data->getAmount();                          
                                       }
                                              
                                    },

                  ];
                }
            }
           return $return;
        }
        
        public static function getHeaderColumns(){
            $return = ['','','',''];
            $account_columns = [];
            $income_columns = [];
            $expense_columns = [];
           
            
            //get account columns
            $accounts = Accounts::find()->all();
            if($accounts){
               
                foreach($accounts as $account){
                    $return[] = ['content'=>$account->account_name, 'options'=>['colspan' => '3']];
                    
                }
            }
            
            //echo "<pre>"; print_r($return);
            
            //get Income columns
            $sources = Source::find()->where(['source_type'=>'Income'])->all();
            if($sources){
                $count_incomes = count($sources);
                $return[] = ['content'=>"Income", 'options'=>['colspan' => $count_incomes],''];
            }
            
            //get Expence columns
            $sources = Source::find()->where(['source_type'=>'Expense'])->all();
            if($sources){
                $count_expenses = count($sources);
                $return[] = ['content'=>"Expenses", 'options'=>['colspan' => $count_expenses],''];
            }
            
            return $return;
            
        }
        
        public static function getHeaderColumnsForExport(){
            $return =[];
            $h1 = ['','','',''];
            $h2 = ['Date','Receipt/Invoice','Cheque no.','Details'];
            $account_columns = [];
            $income_columns = [];
            $expense_columns = [];
           
            
            //get account columns
            $accounts = Accounts::find()->all();
            if($accounts){
               
                foreach($accounts as $account){
                    
                    $h1[] = $account->account_name;
                    $h1[] = '';
                    $h1[] = '';
                    
                    $h2[]='Dr';
                    $h2[]='Cr';
                    $h2[]='Bl';
                }
            }
            
            //echo "<pre>"; print_r($return);
            
            //get Income columns
            $sources = Source::find()->where(['source_type'=>'Income'])->all();
            if($sources){
                $count_incomes = count($sources);
                //Header 1 labels
                for($i=0; $i<=$count_incomes; $i++){
                    if($i == 0){
                        $h1[] = "Income";
                    }
                    else{
                        $h1[] = "";
                    }  
                }
                //Header 2 labels
                foreach($sources as $source){
                    $h2[]=$source->source_name;
                }
            }
            
            //get Expence columns
            $sources = Source::find()->where(['source_type'=>'Expense'])->all();
            if($sources){
                $count_expenses = count($sources);
                //Header 1 labels
                for($i=0; $i<=$count_expenses; $i++){
                    if($i == 0){
                        $h1[] = "Expenses";
                    }
                    else{
                        $h1[] = "";
                    }
                }
                //Header 2 labels
                foreach($sources as $source){
                    $h2[]=$source->source_name;
                }
            }
            $return[]=$h1;
            $return[]=$h2;
            return $return;
        }
        
        public static function getReportData(){
            $return = []; $data=[];
            
            $headerColumns = self::getHeaderColumnsForExport();
            
            //print_r($headerColumns); exit;
            $return = $headerColumns;
            
            //get data
            $transactions = AccountsTransaction::find()->orderBy('id desc')->all();
            if($transactions){
                foreach($transactions as $transaction){
                    //get the four static columns
                    $data=[];
                    $data[]=isset($transaction->fkJournal->date)?$transaction->fkJournal->date:"";
                    $data[]=isset($transaction->fkJournal->receipt_invoice_no)?$transaction->fkJournal->receipt_invoice_no:"";
                    $data[]=isset($transaction->fkJournal->cheque_no)?$transaction->fkJournal->cheque_no :"";
                    $data[]=isset($transaction->fkJournal->details)?$transaction->fkJournal->details :"";
                    
                    //get Accounts Data
                    $transaction->getAccountsData($data);
                    
                    //get Income Data
                    $transaction->getIncomeData($data);
                    
                    //get Expenses Data
                    $transaction->getExpenseData($data);
                    
                    $return[]=$data;
                }
            }
            return $return;
        }
        
        public function getAccountsData(&$data){
            //get all accounts 
            $accounts = Accounts::find()->all();
            if($accounts){
                foreach($accounts as $account){
                    //dr,cr,bl
                    $data[]=($this->fk_account == $account->id)?$this->dr:'';
                    $data[]=($this->fk_account == $account->id)?$this->cr:'';
                    $data[]=($this->fk_account == $account->id)?$this->running_balance:'';
                     
                }
            }
            
        }
	public function getIncomeData(&$data){
            $sources = Source::find()->where(['source_type'=>'Income'])->all();
            if($sources){
                foreach($sources as $source){
                    $data[]= $this->fk_source == $source->id?$this->getAmount():"";
                }
            }
        }
        public function getExpenseData(&$data){
            $sources = Source::find()->where(['source_type'=>'Expense'])->all();
            if($sources){
                foreach($sources as $source){
                    $data[]= $this->fk_source == $source->id?$this->getAmount():"";
                }
            }
        }
}

		


