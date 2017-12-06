<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_lookup_category".
 *
 * @property integer $id
 * @property string $category_name
 *
 * @property Lookup[] $lookups
 */
class LookupCategory extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_lookup_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLookups()
    {
        return $this->hasMany(Lookup::className(), ['category' => 'id']);
    }
    
    public static function getLookupCategoryID($category_name){
        $one = LookupCategory::findOne(['category_name'=>$category_name]);
        
        if($one){
            return $one->id;
        }
    }
}
