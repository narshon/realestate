<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_occupancy_invoice".
 *
 * @property integer $id
 * @property string $invoice_no
 * @property integer $fk_occupancy_rent
 * @property string $created_on
 * @property integer $created_by
 */
class OccupancyInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_no', 'fk_occupancy_rent'], 'required'],
            [['fk_occupancy_rent', 'created_by'], 'integer'],
            [['created_on'], 'safe'],
            [['invoice_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_no' => 'Invoice No',
            'fk_occupancy_rent' => 'Bill Ref No',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
        ];
    }
}
