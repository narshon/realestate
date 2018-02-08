<?php

namespace app\models;

use Yii;
use app\models\LookupCategory;
use app\models\Lookup;

/**
 * This is the model class for table "re_occupancy_payments".
 *
 * @property integer $id
 * @property integer $fk_occupancy_id
 * @property double $amount
 * @property string $payment_date
 * @property integer $fk_receipt_id
 * @property integer $payment_method
 * @property string $ref_no
 * @property integer $status
 * @property integer $created_by
 * @property string $created_on
 * @property integer $modified_by
 * @property string $modified_on
 *
 * @property Occupancy $fkOccupancy
 * @property Receipt $fkReceipt
 */
class OccupancyPayments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy_payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_occupancy_id', 'amount', 'payment_date', 'fk_receipt_id', 'payment_method', 'status'], 'required'],
            [['fk_occupancy_id', 'fk_receipt_id', 'payment_method', 'status', 'created_by', 'modified_by'], 'integer'],
            [['amount'], 'number'],
            [['payment_date', 'created_on', 'modified_on'], 'safe'],
            [['ref_no'], 'string', 'max' => 50],
            [['fk_occupancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occupancy::className(), 'targetAttribute' => ['fk_occupancy_id' => 'id']],
            [['fk_receipt_id'], 'exist', 'skipOnError' => true, 'targetClass' => Receipt::className(), 'targetAttribute' => ['fk_receipt_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_occupancy_id' => 'Occupancy',
            'amount' => 'Amount',
            'payment_date' => 'Payment Date',
            'fk_receipt_id' => 'Receipt',
            'payment_method' => 'Payment Method',
            'ref_no' => 'Ref No',
            'status' => 'Status',
            'created_by' => 'Received By',
            'created_on' => 'Created On',
            'modified_by' => 'Modified By',
            'modified_on' => 'Modified On',
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
    public function getFkReceipt()
    {
        return $this->hasOne(Receipt::className(), ['id' => 'fk_receipt_id']);
    }
    public function beforeValidate() {
        $class = \yii\helpers\StringHelper::basename(get_class($this));
        if(($recept_no = $this->generateReceipt()) !== null && $class == 'OccupancyPayments' && $this->isNewRecord ) {
                $this->fk_receipt_id = $recept_no;
                return parent::beforeValidate();
        } else {
            return false;
        }
    }
    
    public function beforeSave($insert) {
        if($this->isNewRecord) {
            $this->created_by = isset(\yii::$app->user->identity->id) ? \yii::$app->user->identity->id: 1;
            $this->created_on = date('Y-m-d');
        } else {
            $this->modified_by = isset(\yii::$app->user->identity->id) ? \yii::$app->user->identity->id: 1;
            $this->modified_on = date('Y-m-d');
        }
        return parent::beforeSave($insert);
    }
    private function generateReceipt()
    {
        $latest = Receipt::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->one();
        $model = new Receipt();
        $model->receipt_no = $latest !== null ? 'jnr'. (intval(substr($latest->receipt_no, 3)) + 1) :'jnr'. 1;
        $model->date_created = date('Y-m-d H:i:s');
        $model->created_by = isset(\yii::$app->user->identity->id) ? \yii::$app->user->identity->id: 1;
        if($model->save()) {
            return $model->id;
        } else {
            return null;
        }
    }
    
    public function postJournal()
    {
        $journal = new Journal();
        $journal->date = $this->payment_date;
        $journal->receipt_invoice_no = $this->fk_receipt_id;
        $journal->fk_occupancy_rent = $this->id;
        $journal->fk_user = $this->fkOccupancy->fk_user_id;
        $journal->account_type = $this->payment_method;
        //$journal->transaction_type = $occupancyRent->fk_source;
       // $journal->cheque_no = $this->cheque_no;
       //$journal->details = $this->details;
        $journal->transacted_by = Yii::$app->user->identity->id;
        $journal->save(false);
    }
	
	public function getPaymentMethod()
    {
		 $method = LookupCategory::find()->where(['category_name'=>'Payment Method'])->one();
		
        if($method){
			$methodtype = Lookup::find()->where(['_key'=>$this->payment_method, 'category'=>$method->id])->one();
           
				if($methodtype){
			return $methodtype->_value ;			
        }
    }
	}
	
     
}
