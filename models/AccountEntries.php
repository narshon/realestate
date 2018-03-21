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
            [['fk_account_chart', 'created_by', 'origin_id'], 'integer'],
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
            $button = $dh->getModalButton(new journal, '', '', '','',$url);
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
			
            $register_button = $dh->getModalButton(new journal, '', 'Register Expense', 'btn btn-danger btn-register pull-right','Register Expense',$register);
            $transfer_button = $dh->getModalButton(new journal, '', 'Transfer Funds', 'btn btn-danger btn-transfer pull-right','Transfer Funds',$transfer);
             
            $return = '<ul class=" nav nav-pills nav-stacked">';
            $return .= $transfer_button;
            $return .= $register_button."&nbsp; ";
			
			$return .= '</ul>';
      
             return $return;
        }
        
    public static function getDailyReportItem($type, $today = true)
    {
        $date = date('Y-m-d');
        switch($type)
        {
            case 'cash':
                if(($account_type = AccountChart::findone(['code'=> 1101])) !== null) {
                    $debit = AccountEntries::find()
                        ->where(['fk_account_chart' => $account_type->id])
                        ->andWhere(['entry_date' => $date, 'trasaction_type' => 'debit'])
                        ->sum('amount');
                    $credit = AccountEntries::find()
                        ->where(['fk_account_chart' => $account_type->id])
                        ->andWhere(['entry_date' => $date, 'trasaction_type' => 'credit'])
                        ->sum('amount');
                    $debit = ($debit == null)? 0 : $debit;
                    $credit = ($credit == null) ? 0 : $credit;
                    return $debit-$credit;
                        
                }
            case 'rent':
                 if(($account_type = AccountChart::findone(['code'=> 1105])) !== null) {
                     $rent = AccountEntries::find()
                        ->where(['fk_account_chart' => $account_type->id])
                        ->andWhere(['entry_date' => $date, 'trasaction_type' => 'debit'])
                        ->sum('amount');
                 }
                 return ($rent == null) ? 0 : $rent;
                
                
            case 'disbursements':
                if(($account_type = AccountChart::findone(['code'=> 1107])) !== null) {
                     $disbursements = AccountEntries::find()
                        ->where(['fk_account_chart' => $account_type->id])
                        ->andWhere(['entry_date' => $date, 'trasaction_type' => 'debit'])
                        ->sum('amount');
                 }
                 return ($disbursements == null) ? 0 : $disbursements;
           /* case 'penalties_income':
                if(($account_type = AccountChart::findone(['code'=> 1106])) !== null) {
                     $penalties = AccountEntries::find()
                        ->where(['fk_account_chart' => $account_type->id])
                        ->andWhere(['entry_date' => $date, 'trasaction_type' => 'debit'])
                        ->sum('amount');
                 }
                 return ($penalties == null) ? 0 : $penalties;  */
            case 'revenue':
                return '';
                
        }
    }
    
    private static function getDateRange($today)
    {
        if( $today === true)
        {
            
        }
    }
    
    public static function getEntrieQuery($date, $code, $type)
    {
        if(($account_type = AccountChart::findone(['code'=> $code])) !== null) {
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
                    AccountEntries::postTransaction($account->fk_account_chart, $account->transaction_type, $this->amount, $entry_date,$term_id,$account->fkTerm->className(),$this->particulars);
                }
            }
        }
        
        
        return true;
    }

}
