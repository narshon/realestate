<?php

namespace app\models;

use Yii;
use app\models\Estate;
use app\models\SubLocation;

/**
 * This is the model class for table "re_property_area".
 *
 * @property integer $id
 * @property integer $fk_property_id
 * @property integer $fk_sub_location_id
 * @property string $area_desc
 * @property integer $_status
 * @property string $date_created
 * @property string $date_modified
 * @property integer $created_by
 * @property integer $modified_by
 * @property string $area_name
 * @property string $fk_estate_id
 * 
 * @property Property $property
 */
class PropertyArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_property_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_property_id', 'fk_sub_location_id', '_status', 'area_name'], 'required'],
            [['fk_property_id', 'fk_sub_location_id', '_status', 'created_by', 'modified_by', 'fk_estate_id'], 'integer'],
            [['area_desc'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['area_name'], 'string', 'max' => 200],
            [['fk_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['fk_property_id' => 'id']],
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
            'fk_sub_location_id' => 'Fk Sub Location ID',
            'area_desc' => 'Area Desc',
            '_status' => 'Status',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'area_name' => 'Area Name',
            'fk_estate_id' =>'Estate'
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'fk_property_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstate()
    {
        return $this->hasOne(Estate::className(), ['id' => 'fk_estate_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubLocation()
    {
        return $this->hasOne(SubLocation::className(), ['id' => 'fk_sub_location_id']);
    }
    
    public static function getPropertyEstate($property_id){
        
        $propertyArea = PropertyArea::find()->where(['fk_property_id'=>$property_id])->one();
        if($propertyArea){
            if(isset($propertyArea->fk_estate_id)){
                $estate = Estate::find()->where(['id'=>$propertyArea->fk_estate_id])->one();
                if($estate){
                    return ['Estate'=>$estate->estate_name];
                }
            }
        
        }
        
        return [];
    }
    
    public static function getPropertySublocation($property_id){
        
        $propertyArea = PropertyArea::find()->where(['fk_property_id'=>$property_id])->one();
        if($propertyArea){
            if(isset($propertyArea->fk_sub_location_id)){
                $sublocation = SubLocation::find()->where(['id'=>$propertyArea->fk_sub_location_id])->one();
                if($sublocation){
                    return ['Sublocation'=>$sublocation->sub_loc_name];
                }
            }
        
        }
        
        return [];
        
    }
    
    public static function getPlace($property_id){
        $estate_name = ''; $sublocation_name = '';
        $propertyArea = PropertyArea::find()->where(['fk_property_id'=>$property_id])->one();
        if($propertyArea){
              //get estate
                $estate = Estate::find()->where(['id'=>$propertyArea->fk_estate_id])->one();
                if($estate){
                    $estate_name = $estate->estate_name;
                }
                
              //get sublocation
              $sublocation = SubLocation::find()->where(['id'=>$propertyArea->fk_sub_location_id])->one();
                if($sublocation){
                    $sublocation_name = $sublocation->sub_loc_name;
                }
                
                return ['Place' => $estate_name."/".$sublocation_name];
        
        }
        
        return [];
    }
}
