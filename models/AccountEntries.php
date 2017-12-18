<?php

namespace app\models;

use Yii;

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
            [['fk_account_chart', 'created_by'], 'integer'],
            [['trasaction_type'], 'string'],
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
    public static function postTransaction($account_chart, $trasaction_type, $amount, $entry_date)
    {
        $model = new AccountEntries();
        $model->fk_account_chart = $account_chart;
        $model->trasaction_type = $trasaction_type;
        $model->amount = $amount;
        $model->entry_date = $entry_date;
        $model->created_by = Yii::$app->user->identity->id;
        $model->created_on = date('Y-m-d H:i:s');
        $model->save();
    }
}
