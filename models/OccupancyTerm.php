<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_occupancy_term".
 *
 * @property integer $id
 * @property integer $fk_occupancy_id
 * @property integer $fk_property_term_id
 * @property string $date_signed
 * @property integer $_status
 * @property string $date_created
 * @property string $date_modified
 * @property integer $created_by
 * @property integer $modified_by
 *
 * @property OccupancyIssue[] $occupancyIssues
 * @property PropertyTerm $fkPropertyTerm
 * @property Occupancy $fkOccupancy
 */
class OccupancyTerm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy_term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_occupancy_id', 'fk_property_term_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['date_signed', 'date_created', 'date_modified'], 'safe'],
            [['fk_property_term_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertyTerm::className(), 'targetAttribute' => ['fk_property_term_id' => 'id']],
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
            'fk_property_term_id' => 'Fk Property Term ID',
            'date_signed' => 'Date Signed',
            '_status' => 'Status',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyIssues()
    {
        return $this->hasMany(OccupancyIssue::className(), ['fk_related_term' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkPropertyTerm()
    {
        return $this->hasOne(PropertyTerm::className(), ['id' => 'fk_property_term_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOccupancy()
    {
        return $this->hasOne(Occupancy::className(), ['id' => 'fk_occupancy_id']);
    }
    
    public static function getOccupancyTermOptions(){
        $array = [];
        $terms = OccupancyTerm::find()->where(['_status'=>1])->all();
        if($terms){
            foreach($terms as $term){
                $array[$term->id] = $term->fkTerm->term_name;
            }
        }
        
        return $array;
    }
    
    public function beforeSave($insert='insert') {
        
        if (parent::beforeSave($insert)) { 
            $this->date_signed = date('Y-m-d', strtotime($this->date_signed));
            
            
            return true;
        } 
        else { 
            return false; 
            
        }
    }
    
    public function afterFind()
    {

        parent::afterFind();

        $this->date_signed = date('d-m-Y', strtotime($this->date_signed));

    }
}
