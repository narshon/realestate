<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_occupancy".
 *
 * @property integer $id
 * @property integer $fk_property_id
 * @property integer $fk_sublet_id
 * @property integer $fk_tenant_id
 * @property string $start_date
 * @property string $end_date
 * @property string $notes
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Tenant $fkTenant
 * @property Property $fkProperty
 * @property PropertySublet $fkSublet
 * @property OccupancyIssue[] $occupancyIssues
 * @property OccupancyRent[] $occupancyRents
 * @property OccupancyTerm[] $occupancyTerms
 */
class Occupancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_property_id', 'fk_sublet_id', 'fk_tenant_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['start_date', 'end_date', 'date_created', 'date_modified'], 'safe'],
            [['notes'], 'string'],
            [['fk_tenant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tenant::className(), 'targetAttribute' => ['fk_tenant_id' => 'id']],
            [['fk_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['fk_property_id' => 'id']],
            [['fk_sublet_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertySublet::className(), 'targetAttribute' => ['fk_sublet_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_property_id' => 'Fk Property ID',
            'fk_sublet_id' => 'Fk Sublet ID',
            'fk_tenant_id' => 'Fk Tenant ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'notes' => 'Notes',
            '_status' => 'Status',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTenant()
    {
        return $this->hasOne(Tenant::className(), ['id' => 'fk_tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'fk_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkSublet()
    {
        return $this->hasOne(PropertySublet::className(), ['id' => 'fk_sublet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyIssues()
    {
        return $this->hasMany(OccupancyIssue::className(), ['fk_occupancy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyRents()
    {
        return $this->hasMany(OccupancyRent::className(), ['fk_occupancy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyTerms()
    {
        return $this->hasMany(OccupancyTerm::className(), ['fk_occupancy_id' => 'id']);
    }
    
     public function afterFind()
    {

        parent::afterFind();

        $this->start_date = date('d-m-Y', strtotime($this->start_date));
        $this->end_date = date('d-m-Y', strtotime($this->end_date));

    }
    
    public function beforeSave($insert='insert') {
        
        if (parent::beforeSave($insert)) { 
            $this->start_date = date('Y-m-d', strtotime($this->start_date));
            $this->end_date = date('Y-m-d', strtotime($this->end_date));
            
            return true;
        } 
        else { 
            return false; 
            
        }
    }
    
    public static function getOccupancyOptions(){
        $array = [];
        $occupancies = Occupancy::find()->where(['_status'=>1])->all();
        if($occupancies){
            foreach($occupancies as $occupancy){
                $array[$occupancy->id] = $occupancy->fkProperty->property_name.'_'.$occupancy->fkTenant->fkUser->username;
            }
        }
        
        return $array;
    }
    
   

}
