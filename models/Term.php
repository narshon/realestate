<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_term".
 *
 * @property integer $id

 * @property string $term_name
 * @property string $term_desc
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property PropertyTerm[] $propertyTerms
 * @property Lookup $termType
 */
class Term extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
	    [[ 'term_name','term_type'], 'required'],
            [[ '_status', 'created_by', 'modified_by','term_type'], 'integer'],
            [['term_desc','actionhandler'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['term_name'], 'string', 'max' => 200],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
          
            'term_name' => 'Term Name',
            'term_desc' => 'Term Desc',
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
    public function getPropertyTerms()
    {
        return $this->hasMany(PropertyTerm::className(), ['fk_term_id' => 'id']);
    }
    
    public static function getRentTermID(){
        $term = Self::find()->where(['term_name'=>'Rent Amount'])->one();
        
        if($term){
            return $term->id;
        }
    }
    
    public static function  getDisbursementTermID(){
        $term = Self::find()->where(['term_name'=>'Landlord Disbursment Date'])->one();
        
        if($term){
            return $term->id;
        }
    }
    
    public static function getImprestTermID(){
        $term = Self::find()->where(['term_name'=>'Imprest'])->one();
        
        if($term){
            return $term->id;
        }
    }
    
    public static function getPaymentTermID(){
        $term = Self::find()->where(['term_name'=>'Payment'])->one();
        
        if($term){
            return $term->id;
        }
    }
    
    public static function getCommissionTermID(){
        $term = Self::find()->where(['term_name'=>'Agent Commission'])->one();
        
        if($term){
            return $term->id;
        }
    }
    
}
