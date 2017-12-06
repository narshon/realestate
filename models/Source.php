<?php

namespace app\models;

use Yii;
use app\models\AccountsTransaction;

/**
 * This is the model class for table "source".
 *
 * @property int $id
 * @property string $source_name
 * @property string $source_description
 * @property string $source_type
 *
 * @property AccountsTransaction[] $accountsTransactions
 */
class Source extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['source_name','source_type'], 'required'],
            [['source_description','category'], 'string'],
            [['source_name', 'source_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_name' => 'Source Name',
            'source_description' => 'Source Description',
            'source_type' => 'Source Type',
            'category'=>"Category"
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountsTransactions()
    {
        return $this->hasMany(AccountsTransaction::className(), ['fk_source' => 'id']);
    }

    public static function getSourceOptions(){
		
        $all = Source::find()->all();
        $return = [];
        if($all)
        {
                foreach($all as $model){
                        $return[$model->id] = $model->source_name;
                }
        }

        return $return;
        
    }
    public static function getTenantOptions(){
        $all = Source::find()->where(['category'=>'tenant'])->all();
        $return = [];
        if($all)
        {
                foreach($all as $model){
                        $return[$model->id] = $model->source_name;
                }
        }

        return $return;
    } 
    
    public static function getSourceAgentOptions(){
        $all = Source::find()->where(['category'=>'agent'])->all();
        $return = [];
        if($all)
        {
                foreach($all as $model){
                        $return[$model->id] = $model->source_name;
                }
        }

        return $return;
    }
    
    public static function getSourceType($source_id){
        $model = self::find()->where(['id'=>$source_id])->one();
        if($model){
            return $model->source_type;
        }
        else{
            return false;
        }
    }
    
    public static function getMonthlyRentID(){
        $model = self::find()->where(['source_name' => "Rent"])->one();
        if ($model) {
            return $model->id;
        } else {
            return false;
        }
    }
	
}
