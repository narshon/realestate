<?php

namespace app\models;

use Yii;
use app\models\AccountsTransaction;

/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property string $account_name
 * @property string $account_description
 * @property string $account_no
 * @property string $bank_name
 * @property string $branch
 * @property string $bank_code
 * @property string $date_created
 * @property string $created_by
 * @property string $date_modified
 * @property string $modified_by
 *
 * @property AccountsTransaction[] $accountsTransactions
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['account_no', 'account_name','bank_name','branch','bank_code'], 'required'],
            [['account_description'], 'string'],
            [['account_no'], 'number'],
            [['date_created', 'date_modified'], 'safe'],
            [['account_name', 'bank_name', 'branch', 'bank_code', 'created_by', 'modified_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_name' => 'Account Name',
            'account_description' => 'Account Description',
            'account_no' => 'Account No',
            'bank_name' => 'Bank Name',
            'branch' => 'Branch',
            'bank_code' => 'Bank Code',
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
        return $this->hasMany(AccountsTransaction::className(), ['fk_account' => 'id']);
    }
	public static function getAccountOptions(){
		
		$all = Accounts::find()->all();
		$return = [];
		if($all)
		{
			foreach($all as $model){
				$return[$model->id] = $model->account_name;
			}
		}
		
		return $return;
	}
   
	
}
