<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_occupancy_rent".
 *
 * @property integer $id
 * @property integer $fk_occupancy_id
 * @property integer $month
 * @property integer $year
 * @property string $pay_rent_due
 * @property double $balance_due
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Occupancy $fkOccupancy
 */
class OccupancyRent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy_rent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_occupancy_id', 'month', 'year', '_status', 'created_by', 'modified_by'], 'integer'],
            [['pay_rent_due', 'date_created', 'date_modified'], 'safe'],
            [['balance_due'], 'number'],
            [['fk_occupancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occupancy::className(), 'targetAttribute' => ['fk_occupancy_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_occupancy_id' => 'Fk Occupancy ID',
            'month' => 'Month',
            'year' => 'Year',
            'pay_rent_due' => 'Pay Rent Due',
            'balance_due' => 'Balance Due',
            '_status' => 'Status',
            'date_created' => 'Date Create',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOccupancy()
    {
        return $this->hasOne(Occupancy::className(), ['id' => 'fk_occupancy_id']);
    }
}
