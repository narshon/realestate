<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_lookup".
 *
 * @property integer $id
 * @property string $_key
 * @property string $_value
 * @property integer $category
 * @property integer $_order
 * @property integer $_status
 * @property integer $created_by
 * @property string $date_created
 * @property integer $modified_by
 * @property string $date_modified
 *
 * @property LookupCategory $category0
 * @property Property[] $properties
 * @property Term[] $terms
 */
class Lookup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_lookup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_value'], 'string'],
            [['category', '_order', '_status', 'created_by', 'modified_by'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
            [['_key'], 'string', 'max' => 200],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => LookupCategory::className(), 'targetAttribute' => ['category' => 'id']],
        ];
    }
	public function beforeSave($insert){
	  parent::beforeSave($insert);
	
		if ($this->isNewRecord){
			$lastCategory =  Self::find()->where(["category"=>$this->category])->orderBy("_key DESC")->one();
		    
			if($lastCategory){
				$prev_key = $lastCategory->_key;
				$next_key = $prev_key + 1;
				$this->_key = $next_key;
			}
			else{
				$this->_key = 1;
			}
		}
		
		if($this->hasErrors()){
			return false;
		}
		else{
			return true;
		}
	}
	

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            '_key' => 'Key',
            '_value' => 'Value',
            'category' => 'Category',
            '_order' => 'Order',
            '_status' => 'Status',
            'created_by' => 'Created By',
            'date_created' => 'Date Created',
            'modified_by' => 'Modified By',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(LookupCategory::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['property_type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerms()
    {
        return $this->hasMany(Term::className(), ['term_type' => 'id']);
    }
    
    public static function getLookupValues($category_name){
        
       return Lookup::find()->where(['category' => LookupCategory::findOne(['category_name'=>$category_name])])->select(['_value', '_key'])->indexBy('_key')->column();
    }
    
    public static function getLookupCategoryValue($category_id, $_key){
        
        $one = Lookup::findOne(['category'=>$category_id,'_key'=>$_key]);
        
        if($one){
            return $one->_value;
        }
        
    }
    
    
}
