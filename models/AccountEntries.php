<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\bootstrap\Button;
use app\utilities\DataHelper;
use yii\web\Response;
use app\models\AccountChart;
use app\models\Source;
use app\models\AccountMap;



/**
 * This is the model class for table "re_account_entries".
 *
 * @property integer $id
 * @property integer $fk_account_chart
 * @property string $trasaction_type
 * @property double $amount
 * @property string $entry_date
 * @property string $created_on
 * @property integer $created_by
 * @property string $particulars
 */
class AccountEntries extends \yii\db\ActiveRecord
{
    public $account_from;
    public $account_to;
    public $account;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_account_entries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_account_chart', 'amount', 'entry_date'], 'required'],
            [['fk_account_chart', 'created_by', 'origin_id','account_from','account_to','account'], 'integer'],
            [['trasaction_type','origin_model','particulars'], 'string'],
            [['amount'], 'number'],
            [['entry_date', 'created_on'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_account_chart' => 'Account',
            'trasaction_type' => 'Trasaction Type',
            'amount' => 'Amount',
            'entry_date' => 'Date',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
        ];
    }
	 /**
     * @return \yii\db\ActiveQuery
     */
    public function getfkAccountChart()
    {
        return $this->hasOne(AccountChart::className(), ['id' => 'fk_account_chart']);
    }
	
    public static function postTransaction($account_chart, $trasaction_type, $amount, $entry_date,$origin_id='', $origin_model='', $particulars='')
    {
        $model = new AccountEntries();
        $model->fk_account_chart = $account_chart;
        $model->trasaction_type = $trasaction_type;
        $model->amount = $amount;
        $model->particulars = $particulars;
        $model->entry_date = $entry_date;
        $model->created_by = Yii::$app->user->identity->id;
        $model->created_on = date('Y-m-d H:i:s');
        $model->origin_id = $origin_id;
        $model->origin_model = $origin_model;
        $model->save();
    }
	public static function showButtons(){
            $accountentries = Url::to(['account-entries/index']);
            $source = Url::to(['source/index']);
			$accountchart = Url::to(['account-chart/index']);
            $accountmap = Url::to(['account-map/index']);
			$accounttype = Url::to(['account-type/index']);
            $dh = new DataHelper();
            $url = Url::to(['journal/transfer']);  //'site/update-data'
            $button = $dh->getModalButton(new Journal, '', '', '','',$url);
            $return = '<ul class=" nav nav-pills nav-stacked">';
            $return .= $button;
            $return .= Button::widget(["label" => "Account Type", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$accounttype')"]]);
			$return .= Button::widget(["label" => "Account Map", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$accountmap')"]]);
            $return .= Button::widget(["label" => "Accounts Chart", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$accountchart')"]]);
            $return .= Button::widget(["label" => "Source", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$source')"]]);
            $return .= Button::widget(["label" => "Account Entries", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$accountentries')"]]);
            $return .= '</ul>';
      
             return $return;
        }
		
	public static function actionButtons(){
            $dh = new DataHelper();
            $transfer = Url::to(['account-entries/transfer']);
            $register = Url::to(['account-entries/create']);
			
            $register_button = $dh->getModalButton(new Journal, '', 'Register Expense', 'btn btn-danger btn-register pull-right','Register Expense',$register);
            $transfer_button = $dh->getModalButton(new Journal, '', 'Transfer Funds', 'btn btn-danger btn-transfer pull-right','Transfer Funds',$transfer);
             
            $return = '<ul class=" nav nav-pills nav-stacked">';
            $return .= $transfer_button;
            $return .= $register_button."&nbsp; ";
			
			$return .= '</ul>';
      
             return $return;
        }
        
    public static function getDailyReportItem($code, $date = true)
    {
        if(($account_type = AccountChart::findone(['code'=> $code])) !== null) {
            $debit = AccountEntries::find()
                ->where(['fk_account_chart' => $account_type->id])
                ->andWhere(['and',
                            ['<=','entry_date', $date],
                            ['trasaction_type' => 'debit']])
                ->sum('amount');
            $credit = AccountEntries::find()
                ->where(['fk_account_chart' => $account_type->id])
                ->andWhere(['and',
                       ['<=','entry_date', $date], ['trasaction_type' => 'credit']])
                ->sum('amount');
            $debit = ($debit == null)? 0 : $debit;
            $credit = ($credit == null) ? 0 : $credit;
            return $debit-$credit;
        }
    }
    
    private static function getDateRange($today)
    {
        if( $today === true)
        {
            
        }
    }
    
    public static function getEntrieQuery($date, $account_id, $type)
    {
        if(($account_type = AccountChart::findone(['id'=> $account_id])) !== null) {
            if($type === true) {
                $query = AccountEntries::find()
                ->where(['fk_account_chart' => $account_type->id])
                ->andWhere(['entry_date' => $date]);
            } else {
                $query = AccountEntries::find()
                    ->where(['fk_account_chart' => $account_type->id])
                    ->andWhere(['entry_date' => $date, 'trasaction_type' => $type]);
            }
            return $query;
        }
    }
    
    public static function getTotal($provider, $columnName)
    {
        $total = 0;
        foreach ($provider as $item) {
          $total += $item[$columnName];
        }
        return $total;  
    }
    
    public function updateExpenseAccounts()
    {
        $account = AccountMap::find()->where(['fk_account_chart'=>$this->fk_account_chart])->one();
        if($account){
            $term_id = $account->fk_term;
            $entry_date = date("Y-m-d", strtotime($this->entry_date));
            $accountmap = AccountMap::findAll(['fk_term' => $term_id]);
            if(is_array($accountmap)) {
                foreach($accountmap as $account) {
                    if($account->transaction_type == "credit"){
                        $acc = $this->account;
                    }
                    else{
                        $acc = $account->fk_account_chart;
                    }
                    AccountEntries::postTransaction($acc, $account->transaction_type, $this->amount, $entry_date,$term_id,$account->fkTerm->className(),$this->particulars);
                }
            }
        }
        
        
        return true;
    }
    
    public function validateExpenses(){
        if($this->amount == ""){
            $this->addError('amount', "Amount cannot be blank");
        }
        if($this->account == ""){
            $this->addError('account', "Funds cannot be blank");
        }
        if($this->fk_account_chart == ""){
            $this->addError('fk_account_chart', "Expense Account cannot be blank");
        }
        if($this->particulars == ""){
            $this->addError('particulars', "Particulars cannot be blank");
        }
        if($this->entry_date == ""){
            $this->addError('entry_date', "Date cannot be blank");
        }
        
        //check if we have sufficient funds.
        $date = date("Y-m-d", strtotime($this->entry_date));
        $checkfunds = \app\models\AccountChart::checkSufficientFunds($this->account, $this->amount, $date);
        if($checkfunds == false){
            $this->addError('account', "Insufficient Funds, cannot record expense");
        }
        
        if($this->hasErrors()){
            return false;
        }
        else{
            return true;
        }
    }
    
    public function transferValidations(){
        //get accounts, check if source has sufficient amount.
        $account_from = $this->account_from;
        $sourceAccount = AccountChart::findone(['id'=>$account_from]);
        if($sourceAccount){
            //get the balance as at the given date.
            $balance = Self::getAccountBalance($sourceAccount->id, date("Y-m-d",strtotime($this->entry_date)));
            
            if($balance < $this->amount){
                $this->addError('account_from', $sourceAccount->id." Account Has Insufficient Funds.");
            }
        }
        else{
            $this->addError('account_from', "Source account not found.");
        }
        
        if($this->hasErrors()){
            return false;
        }
        else{
            return true;
        }

    }
    
    public static function getAccountBalance($account_id, $date){
        
           $debit_sum  = AccountEntries::find()
                        ->where(['fk_account_chart' => $account_id, 'trasaction_type' => 'debit'])
                        ->andWhere( "entry_date <= '$date' " )
                        ->sum('amount');
            $debit_sum = ($debit_sum == null) ? 0 : $debit_sum;
            
            $credit_sum  = AccountEntries::find()
                        ->where(['fk_account_chart' => $account_id, 'trasaction_type' => 'credit'])
                        ->andWhere( "entry_date <= '$date' " )
                        ->sum('amount');
            $credit_sum = ($credit_sum == null) ? 0 : $credit_sum;
            
            $balance = $debit_sum - $credit_sum;
            
            return $balance;
    }
    
    public function transfer(){
        $sourceAccount = AccountChart::findone(['id'=>$this->account_from]);
        if($sourceAccount){
            //dest account.
            $destAccount = AccountChart::findone(['id'=>$this->account_to]);
            if($destAccount){
                //transfer. credit source and debit dest.
                $entry = new AccountEntries();
                $entry->fk_account_chart = $sourceAccount->id;
                $entry->trasaction_type = "credit";
                $entry->particulars = "Transfer funds to ".$destAccount->name;
                $entry->amount = $this->amount;
                $entry->entry_date = date("Y-m-d",strtotime($this->entry_date));
                $entry->created_on = date("Y-m-d H:i:s");
                $entry->created_by = Yii::$app->user->identity->id;
                if($entry->save(false)){
                    $entry = new AccountEntries();
                    $entry->fk_account_chart = $destAccount->id;
                    $entry->trasaction_type = "debit";
                    $entry->particulars = "Transfer funds from ".$sourceAccount->name;
                    $entry->amount = $this->amount;
                    $entry->entry_date = date("Y-m-d",strtotime($this->entry_date));
                    $entry->created_on = date("Y-m-d H:i:s");
                    $entry->created_by = Yii::$app->user->identity->id;
                    $entry->save(false);
                }
            }
        }
        
        return true;
    }
    
    public static function getNavigationItems(){
        $dreport_url = Url::to(['account-entries/index']);
        $statement = Url::to(['account-entries/account-statement','string'=>32]); //defaults to cash account
        $pending = Url::to(['account-entries/pending']);
        $trial = Url::to(['account-entries/trial']);
        $iereport = Url::to(['account-entries/iereport']);
        $monthly = Url::to(['account-entries/monthly']);
        $charts = Url::to(['account-chart/index']);
        $map = Url::to(['account-map/index']);
        $accounttype = Url::to(['account-type/index']);
        
        return [
                'Reports' => [
                    'label' => 'Financial Reports',
                    "content"=>[
                        '<li class="nav-item list-group-item"><a class="nav-link active"  href="'.$dreport_url.'" role="tab">Daily Reports</a></li>',
                        '<li class="nav-item list-group-item"><a class="nav-link"  href="'.$statement.'" role="tab">Account statement</a></li>',
                        '<li class="nav-item list-group-item"><a class="nav-link"  href="'.$pending.'" role="tab">Pending Rent</a></li>',
                        '<li class="nav-item list-group-item"><a class="nav-link"  href="'.$trial.'" role="tab">Trial Balance</a></li>',
                        '<li class="nav-item list-group-item"><a class="nav-link"  href="'.$iereport.'" role="tab">I&E Report</a></li>',
                        '<li class="nav-item list-group-item"><a class="nav-link"  href="'.$monthly.'" role="tab">Monthly Report</a></li>'
                    ],
                    'contentOptions' => ['class' => 'in']
                    ],
                'Settings' => [
                    'label' => 'Settings',
                    'content' => [

                        '<li class="nav-item list-group-item"><a class="nav-link"  href="'.$charts.'" role="tab">Account Charts</a></li>',
                        '<li class="nav-item list-group-item"><a class="nav-link"  href="'.$map.'" role="tab">Account Map</a></li>',
                        '<li class="nav-item list-group-item"><a class="nav-link"  href="'.$accounttype.'" role="tab">Account Type</a></li>',

                    ]
                ]
                                      
        ];
    }
    
    public function getClientName(){
         $originModel = $this->origin_model;
        if($originModel == "app\models\OccupancyPayments"){
            //occupancyRent
            $occupancyPayment = $originModel::findone(['id'=>$this->origin_id]);
            if($occupancyPayment){
                return $occupancyPayment->fkOccupancy->fkTenant->getNames();
            }
        }
        else{
            return $this->particulars;
        }
    }
    public function getHouse(){
        $originModel = $this->origin_model;
        if($originModel == "app\models\OccupancyPayments"){

            //occupancyRent
            $occupancyPayment = $originModel::findone(['id'=>$this->origin_id]);
            if($occupancyPayment){
                return $occupancyPayment->fkOccupancy->fkProperty->id;
            }

        }
    }
    public function getCRent(){
        //get origin of this transaction
        $originModel = $this->origin_model;
        if($originModel == "app\models\OccupancyPayments"){
            //get payment mappings of this transaction.
            $pay = \app\models\OccupancyPayments::findone(['id'=>$this->origin_id]);
            $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$this->origin_id]);
            if($payMaps){

                $currentMonth = date("m", strtotime($pay->payment_date));
                $currentYear = date("Y", strtotime($pay->payment_date));
                foreach($payMaps as $payMap){
                    //check if the bill for this mapping was for current month.
                    if($payMap->fkOccupancyRent->fk_term == 1){ //Rent Amount
                        if($currentMonth == $payMap->fkOccupancyRent->month && $currentYear ==  $payMap->fkOccupancyRent->year){
                            return $payMap->amount;
                        }

                    }
                }
            }
        }
      return "";  
    }
    public function getRentBal(){
        
        //get origin of this transaction
        $originModel = $this->origin_model;
        if($originModel == "app\models\OccupancyPayments"){
            //get payment mappings of this transaction.
            $pay = \app\models\OccupancyPayments::findone(['id'=>$this->origin_id]);
            $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$this->origin_id]);
            if($payMaps){
                $amount = 0;
                $currentMonth = date("m", strtotime($pay->payment_date));
                $currentYear = date("Y", strtotime($pay->payment_date));
                foreach($payMaps as $payMap){
                    //check if the bill for this mapping was for current month.
                    if($payMap->fkOccupancyRent->fk_term == Term::getRentTermID()){ //Rent Amount

                        if($currentYear >  $payMap->fkOccupancyRent->year || $currentMonth > $payMap->fkOccupancyRent->month){
                            $amount += $payMap->amount;
                        }
                        
                    }
                }
                return $amount;
            }
        }
      return "";    
    }
    public function getVLockFee(){
        //get payment mappings of this transaction.
        $pay = \app\models\OccupancyPayments::findone(['id'=>$this->origin_id]);
        $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$this->origin_id]);
        if($payMaps){
            $visit_term_id = Term::getTermID("Visit Fees");
            $locking_term_id = Term::getTermID("Locking Fees");
            $cumulative = 0;
            foreach($payMaps as $payMap){
                //check if the bill for this mapping is what we are looking for
                if($payMap->fkOccupancyRent->fk_term == $visit_term_id || $payMap->fkOccupancyRent->fk_term == $locking_term_id ){ //Visit fee | locking fee.
                    $cumulative += $payMap->amount;
                }
            }
            return $cumulative > 0? $cumulative:"";
        }

        return "";    
    }
    public function getAgencyFee(){
        //get payment mappings of this transaction.
        $pay = \app\models\OccupancyPayments::findone(['id'=>$this->origin_id]);
        $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$this->origin_id]);
        if($payMaps){
            $agency_term_id = Term::getTermID("Agency Fee");

            foreach($payMaps as $payMap){
                //check if the bill for this mapping is what we are looking for
                if($payMap->fkOccupancyRent->fk_term == $agency_term_id ){ //Agency fee.
                   return $payMap->amount;
                }
            }
        }

        return "";    
    }
    public function getOtherFee(){
        //get payment mappings of this transaction.
        $pay = \app\models\OccupancyPayments::findone(['id'=>$this->origin_id]);
        $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$this->origin_id]);
        if($payMaps){
            $agency_term_id = Term::getTermID("Agency Fee");
            $visit_term_id = Term::getTermID("Visit Fees");
            $locking_term_id = Term::getTermID("Locking Fees");
            $rent_term_id = Term::getRentTermID();
            $forbiden_terms = [$agency_term_id, $visit_term_id, $locking_term_id, $rent_term_id];
            $cumulative = 0;
            foreach($payMaps as $payMap){
                //check if the bill for this mapping is what we are looking for
                if(!in_array($payMap->fkOccupancyRent->fk_term, $forbiden_terms) ){ //other fee.
                    $cumulative += $payMap->amount;
                }
            }
            return $cumulative > 0? $cumulative:"";
        }

        return "";    
    }
    
    public static function getTotalCRent($account_no, $from, $to){
            $return = 0;
            //get transactions between these dates.
            $models = Self::find()->where("(fk_account_chart = $account_no) and ( entry_date between '$from' and '$to')")->all();
            if($models){
                foreach($models as $model){
                    $originModel = $model->origin_model;
                    if($originModel == "app\models\OccupancyPayments"){
                        //get payment mappings of this transaction.
                        $pay = \app\models\OccupancyPayments::findone(['id'=>$model->origin_id]);
                        $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$model->origin_id]);
                        if($payMaps){
                            $currentMonth = date("m", strtotime($pay->payment_date));
                            $currentYear = date("Y", strtotime($pay->payment_date));
                            foreach($payMaps as $payMap){
                                //check if the bill for this mapping was for current month.
                                if($payMap->fkOccupancyRent->fk_term == 1){ //Rent Amount
                                    if($currentMonth == $payMap->fkOccupancyRent->month && $currentYear ==  $payMap->fkOccupancyRent->year){
                                        $return += $payMap->amount;
                                    }

                                }
                            }
                        }
                    }
                }
            }        
            return $return;
    }
    public static function getTotalBalance($account_no, $from, $to){
         $amount = 0;
        //get transactions between these dates.
        $models = Self::find()->where("(fk_account_chart = $account_no) and ( entry_date between '$from' and '$to')")->all();
        if($models){
            foreach($models as $model){
                //get origin of this transaction
                $originModel = $model->origin_model;
                if($originModel == "app\models\OccupancyPayments"){
                    //get payment mappings of this transaction.
                    $pay = \app\models\OccupancyPayments::findone(['id'=>$model->origin_id]);
                    $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$model->origin_id]);
                    if($payMaps){
                        
                        $currentMonth = date("m", strtotime($pay->payment_date));
                        $currentYear = date("Y", strtotime($pay->payment_date));
                        foreach($payMaps as $payMap){
                            //check if the bill for this mapping was for current month.
                            if($payMap->fkOccupancyRent->fk_term == Term::getRentTermID()){ //Rent Amount

                                if($currentYear >  $payMap->fkOccupancyRent->year || $currentMonth > $payMap->fkOccupancyRent->month){
                                    $amount += $payMap->amount;
                                }

                            }
                        }
                        
                    }
                }
            }
        }
        return $amount;
        
    }
    public static function getTotalVLockFee($account_no, $from, $to){
        $cumulative = 0;
        //get transactions between these dates.
        $models = Self::find()->where("(fk_account_chart = $account_no) and ( entry_date between '$from' and '$to')")->all();
        if($models){
            foreach($models as $model){
                //get payment mappings of this transaction.
                $pay = \app\models\OccupancyPayments::findone(['id'=>$model->origin_id]);
                $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$model->origin_id]);
                if($payMaps){
                    $visit_term_id = Term::getTermID("Visit Fees");
                    $locking_term_id = Term::getTermID("Locking Fees");
                    
                    foreach($payMaps as $payMap){
                        //check if the bill for this mapping is what we are looking for
                        if($payMap->fkOccupancyRent->fk_term == $visit_term_id || $payMap->fkOccupancyRent->fk_term == $locking_term_id ){ //Visit fee | locking fee.
                            $cumulative += $payMap->amount;
                        }
                    }
                    
                }
            }
        }
        return $cumulative;
    }
    public static function getTotalAgencyFee($account_no, $from, $to){
        $return = 0;
        //get transactions between these dates.
        $models = Self::find()->where("(fk_account_chart = $account_no) and ( entry_date between '$from' and '$to')")->all();
        if($models){
            foreach($models as $model){
                //get payment mappings of this transaction.
                $pay = \app\models\OccupancyPayments::findone(['id'=>$model->origin_id]);
                $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$model->origin_id]);
                if($payMaps){
                    $agency_term_id = Term::getTermID("Agency Fee");

                    foreach($payMaps as $payMap){
                        //check if the bill for this mapping is what we are looking for
                        if($payMap->fkOccupancyRent->fk_term == $agency_term_id ){ //Agency fee.
                           $return += $payMap->amount;
                        }
                    }
                }
            }
        }
        return $return;
    }
    public static function getTotalOtherFee($account_no, $from, $to){
        $cumulative = 0;
        //get transactions between these dates.
        $models = Self::find()->where("(fk_account_chart = $account_no) and ( entry_date between '$from' and '$to')")->all();
        if($models){
            foreach($models as $model){
                //get payment mappings of this transaction.
                $pay = \app\models\OccupancyPayments::findone(['id'=>$model->origin_id]);
                $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$model->origin_id]);
                if($payMaps){
                    $agency_term_id = Term::getTermID("Agency Fee");
                    $visit_term_id = Term::getTermID("Visit Fees");
                    $locking_term_id = Term::getTermID("Locking Fees");
                    $rent_term_id = Term::getRentTermID();
                    $forbiden_terms = [$agency_term_id, $visit_term_id, $locking_term_id, $rent_term_id];
                    foreach($payMaps as $payMap){
                        //check if the bill for this mapping is what we are looking for
                        if(!in_array($payMap->fkOccupancyRent->fk_term, $forbiden_terms) ){ //other fee.
                            $cumulative += $payMap->amount;
                        }
                    }
                }
            }
        }
        return $cumulative;
    }
    
    public static function getTotalAmountReceived($account_no, $from, $to){
        $cumulative = 0;
        //get transactions between these dates.
        $models = Self::find()->where("(fk_account_chart = $account_no) and trasaction_type='debit' and ( entry_date between '$from' and '$to')")->all();
        if($models){
            foreach($models as $model){
                //get payment mappings of this transaction.
                $pay = \app\models\OccupancyPayments::findone(['id'=>$model->origin_id]);
                if($pay){
                    $cumulative += $model->amount;
                }
            }
        }
        
        return $cumulative;
    }
    
    public function getTransactedUser(){
        $originModel = $this->origin_model;
        $originID = $this->origin_id;
        if($originModel == "app\models\OccupancyPayments"){ //refunds
            $model = \app\models\OccupancyPayments::findone(['id'=>$originID]);
            if($model){
                return $model->fkOccupancy->fkTenant->getNames();
            }
        }
        elseif($originModel == "app\models\LandlordImprest"){ //payments to landlords
            $model = \app\models\LandlordImprest::findone(['id'=>$originID]);
            if($model){
                return $model->fkLandlord->getNames();
            }
        }
        elseif($originModel == "app\models\Term"){
            return "Office Expenses";
        }
    }
    public function getTransactionSourceName(){
        $originModel = $this->origin_model;
        $originID = $this->origin_id;
        if($originModel == "app\models\OccupancyPayments"){ //refunds
            return "Refunds";
        }
        elseif($originModel == "app\models\LandlordImprest"){ //payments to landlords
            return "Landlord Imprest";
        }
        elseif($originModel == "app\models\Term"){
            $model = \app\models\Term::findone(['id'=>$originID]);
            if($model){
                return $model->term_name;
            }
            
        }
    }
    public function getTransactionParticulars(){
        return $this->particulars;
    }
    
    public static function getTotalAmountPaid($account_no, $from, $to){
        $cumulative = 0;
        //get transactions between these dates.
        $models = Self::find()->where("(fk_account_chart = $account_no) and ( entry_date between '$from' and '$to') and trasaction_type='credit'")->all();
        if($models){
            foreach($models as $model){
                
                    $cumulative += $model->amount;
            }
        }
        
        return $cumulative;
    }
    

}
