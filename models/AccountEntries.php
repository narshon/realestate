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
            [['fk_account_chart', 'trasaction_type', 'amount', 'entry_date'], 'required'],
            [['fk_account_chart', 'created_by', 'origin_id'], 'integer'],
            [['trasaction_type','origin_model'], 'string'],
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
            'fk_account_chart' => 'Fk Account Chart',
            'trasaction_type' => 'Trasaction Type',
            'amount' => 'Amount',
            'entry_date' => 'Entry Date',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
        ];
    }
    public static function postTransaction($account_chart, $trasaction_type, $amount, $entry_date,$origin_id='', $origin_model='')
    {
        $model = new AccountEntries();
        $model->fk_account_chart = $account_chart;
        $model->trasaction_type = $trasaction_type;
        $model->amount = $amount;
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
            $button = $dh->getModalButton(new journal, '', 'Transfer Funds', 'btn btn-danger btn-create btn-new pull-right','Transfer Funds',$url);
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
            $transfer = Url::to(['account-entries/transfer']);
            $register = Url::to(['account-entries/register']);
			$dh = new DataHelper();
			$url = Url::to(['account-entries/transfer']);
			$button = $dh->getModalButton(new journal, '', 'Transfer Funds', 'btn btn-danger btn-create btn-new pull-right','Transfer Funds',$url);
             
            $return = '<ul class=" nav nav-pills nav-stacked">';
            $return .= $button;
            $return .= Button::widget(["label" => "Register Expense", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$register')"]]);
			$newentry = Url::to(['account-entries/create']);  //'site/update-data'
		   echo $dh->getModalButton(new AccountEntries, 'account-entries/create', 'Account-entries', 'btn btn-danger btn-create btn-new pull-right','New ',$newentry);
		
			$return .= '</ul>';
      
             return $return;
        }

}
