<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_account_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $Description
 * @property integer $created_by
 * @property integer $modified_by
 * @property string $created_on
 * @property string $modified_on
 *
 * @property AccountChart[] $accountCharts
 */
class AccountType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_account_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'Description'], 'required'],
            [['created_by', 'modified_by'], 'integer'],
            [['created_on', 'modified_on'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['Description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'Description' => 'Description',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_on' => 'Created On',
            'modified_on' => 'Modified On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCharts()
    {
        return $this->hasMany(AccountChart::className(), ['fk_re_account_type' => 'id']);
    }
    
    public function beforeSave($insert){
        if($this->isNewRecord){
            $this->created_on = Date("Y-m-d");
            $this->created_by = Yii::$app->user->identity->id;
        }
        else{
            $this->modified_on = Date("Y-m-d");
            $this->modified_by = Yii::$app->user->identity->id;
        }
        
        if($this->hasErrors()){
            return false;
        }
        else{
            return true;
        }
    }
    
    public static function getAccountTypeOptions(){
        $return = [];
        $models = Self::find()->all();
        if($models){
            foreach($models as $model){
                $return[$model->id] = $model->name;
            }
        }
        
        return $return;
    }
    
    public static function getAccountTypeID($type_name){
        $model = Self::find()->where(['name'=>$type_name])->one();
        if($model){
           return $model->id;
        }
    }
}
