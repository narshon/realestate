<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_receipt".
 *
 * @property integer $id
 * @property string $receipt_no
 * @property string $date_created
 * @property integer $created_by
 *
 * @property OccupancyPayments[] $occupancyPayments
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_receipt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receipt_no'], 'required'],
            [['date_created'], 'safe'],
            [['created_by'], 'integer'],
            [['receipt_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receipt_no' => 'Receipt No',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyPayments()
    {
        return $this->hasMany(OccupancyPayments::className(), ['fk_receipt_id' => 'id']);
    }
}
