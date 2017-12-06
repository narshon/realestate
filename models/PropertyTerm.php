<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_property_term".
 *
 * @property integer $id
 * @property integer $fk_property_id
 * @property integer $fk_term_id
 * @property string $term_title
  * @property string $term_value
 * @property string $term_narration
 * @property string $action_handler
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property OccupancyTerm[] $occupancyTerms
 * @property Term $fkTerm
 * @property Property $fkProperty
 */
class PropertyTerm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_property_term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_property_id', 'fk_term_id','term_title'], 'required'],
            [['fk_property_id', 'fk_term_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['term_narration','term_value'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['term_title', 'action_handler'], 'string', 'max' => 200],
            [['fk_term_id'], 'exist', 'skipOnError' => true, 'targetClass' => Term::className(), 'targetAttribute' => ['fk_term_id' => 'id']],
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
            'fk_property_id' => 'Property',
            'fk_term_id' => 'Term',
            'term_title' => 'Term Title',
            'term_value'=>'Value',
            'term_narration' => 'Term Narration',
            'action_handler' => 'Action Handler',
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
    public function getOccupancyTerms()
    {
        return $this->hasMany(OccupancyTerm::className(), ['fk_property_term_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTerm()
    {
        return $this->hasOne(Term::className(), ['id' => 'fk_term_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'fk_property_id']);
    }
    
    public static function getPropertyTermsOptions($property_id){
        $array = [];
        $terms = PropertyTerm::find()->where(['_status'=>1,'fk_property_id'=>$property_id])->all();
        if($terms){
            foreach($terms as $term){
                $array[$term->id] = $term->fkProperty->property_name.'_'.$term->fkTerm->term_name;
            }
        }
        
        return $array;
    }
    
    public static function getPrice($property_id){
        //get monthly rent of this property.
        $term = Term::find()->where(['term_name'=>'Monthly Rent'])->one();
        $term_id = '';
        if($term){
            $term_id = $term->id;
            
            //get the property term for this term.
            $propertyterm = PropertyTerm::find()->where(['_status'=>1, 'fk_term_id'=>$term_id, 'fk_property_id'=>$property_id ])->one();
            if($propertyterm){
                return ['Monthly Rent'=>$propertyterm->term_narration];
            }
        }
        
        return [];
        
    }
    
    public static function getTermValue($term_id,$property_id,$occupancy_id=''){
        $propertyterm = Self::find()->where(['fk_term_id'=>$term_id,'fk_property_id'=>$property_id,'_status'=>1])->one();
        if($propertyterm){
            //check if we have an occupancy term, overridden rule at occupant level.
            $occupanyterm = OccupancyTerm::find()->where(['fk_occupancy_id'=>$occupancy_id,'fk_property_term_id'=>$propertyterm->id,'_status'=>1])->one();
            if($occupanyterm){
                //get the value of this term
                return $occupanyterm->value;
            }
            else{
                return $propertyterm->term_value;
            }
        }
    }
}
