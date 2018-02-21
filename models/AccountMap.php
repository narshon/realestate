<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_account_map".
 *
 * @property integer $id
 * @property integer $fk_term
 * @property integer $fk_account_chart
 * @property string $transaction_type
 * @property integer $status
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 *
 * @property Term $fkTerm
 * @property AccountChart $fkAccountChart
 */
class AccountMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_account_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_term', 'fk_account_chart', 'transaction_type', 'status'], 'required'],
            [['fk_term', 'fk_account_chart', 'status', 'created_by', 'modified_by'], 'integer'],
            [['transaction_type'], 'string'],
            [['created_on', 'modified_on'], 'safe'],
            [['fk_term'], 'exist', 'skipOnError' => true, 'targetClass' => Term::className(), 'targetAttribute' => ['fk_term' => 'id']],
            [['fk_account_chart'], 'exist', 'skipOnError' => true, 'targetClass' => AccountChart::className(), 'targetAttribute' => ['fk_account_chart' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_term' => 'Fk Term',
            'fk_account_chart' => 'Fk Account Chart',
            'transaction_type' => 'Transaction Type',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modified_on' => 'Modified On',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTerm()
    {
        return $this->hasOne(Term::className(), ['id' => 'fk_term']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkAccountChart()
    {
        return $this->hasOne(AccountChart::className(), ['id' => 'fk_account_chart']);
    }
    
    public function getFkAccountEntries()
    {
        return $this->hasMany(AccountEntries::className(), ['fk_account_chart' => 'id']);
    }
}
