<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_users".
 *
 * @property integer $id
 * @property integer $fk_group_id
 * @property string $username
 * @property string $pass
 * @property string $name1
 * @property string $name2
 * @property string $name3
 * @property integer $age
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $date_added
 * @property string $gender
 * @property string $color_code
 * @property string $icon_id
 *
 * @property Advert[] $adverts
 * @property Advert[] $adverts0
 * @property Blog[] $blogs
 * @property Feature[] $features
 * @property Feature[] $features0
 * @property PropertyFeatureImage[] $propertyFeatureImages
 * @property PropertyFeatureImage[] $propertyFeatureImages0
 * @property Tenant[] $tenants
 * @property Group $fkGroup
 */
class SysUsers extends \yii\db\ActiveRecord
{
    public $confirmpass;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_group_id', 'age','fk_management_id'], 'integer'],
            [['address'], 'string'],
            [['date_added'], 'safe'],
            [['username', 'pass','confirmpass'], 'string', 'max' => 50],
            [['name1', 'name2', 'name3'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 500],
            [['phone', 'color_code'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 2],
            [['icon_id'], 'string', 'max' => 11],
            [['phone'], 'unique'],
            [['fk_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['fk_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_group_id' => 'Group',
            'fk_management_id' => 'Management',
            'username' => 'Username',
            'pass' => 'Password',
            'confirmpass' => 'Confirm Password',
            'name1' => 'Name1',
            'name2' => 'Name2',
            'name3' => 'Name3',
            'age' => 'Age',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'date_added' => 'Date Added',
            'gender' => 'Gender',
            'color_code' => 'Color Code',
            'icon_id' => 'Icon ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['modified_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts0()
    {
        return $this->hasMany(Advert::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['fk_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatures()
    {
        return $this->hasMany(Feature::className(), ['modified_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatures0()
    {
        return $this->hasMany(Feature::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatureImages()
    {
        return $this->hasMany(PropertyFeatureImage::className(), ['modified_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatureImages0()
    {
        return $this->hasMany(PropertyFeatureImage::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenants()
    {
        return $this->hasMany(Tenant::className(), ['fk_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'fk_group_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkManagement()
    {
        return $this->hasOne(Management::className(), ['id' => 'fk_management_id']);
    }
    
    public function beforeSave($insert) {
        
        if (parent::beforeSave($insert)) { 
            if($this->pass === $this->confirmpass){
                $this->pass = md5($this->pass);
               return true; 
            }
            else{
                $this->addError('pass', 'Passwords do not match');
                return false; 
            }
        } 
        else { 
            return false; 
            
        }
    }
    
}
