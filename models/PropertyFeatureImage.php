<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_property_feature_image".
 *
 * @property integer $id
 * @property integer $fk_property_feature_id
 * @property string $image_url
 * @property string $image_title
 * @property string $image_caption
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property SysUsers $modifiedBy
 * @property PropertyFeature $fkPropertyFeature
 * @property SysUsers $createdBy
 */
class PropertyFeatureImage extends \yii\db\ActiveRecord
{
    public $img_temp_url = '';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_property_feature_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_property_feature_id'], 'required'],
            [['fk_property_feature_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['image_url', 'image_caption', 'img_temp_url'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['image_title'], 'string', 'max' => 200],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => SysUsers::className(), 'targetAttribute' => ['modified_by' => 'id']],
            [['fk_property_feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertyFeature::className(), 'targetAttribute' => ['fk_property_feature_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => SysUsers::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_property_feature_id' => '',
            'image_url' => 'Image Url',
            'image_title' => 'Image Title',
            'image_caption' => 'Image Caption',
            '_status' => 'Status',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
            'img_temp_url'=>''
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(SysUsers::className(), ['id' => 'modified_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkPropertyFeature()
    {
        return $this->hasOne(PropertyFeature::className(), ['id' => 'fk_property_feature_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(SysUsers::className(), ['id' => 'created_by']);
    }
    
    public function beforeSave($insert) {
        
        $this->image_url = $this->img_temp_url;
        
        parent::beforeSave($insert);
        
        if($this->hasErrors()){
            return false;
        }
        else{
            return true;
        }
    }
    
    public static function getPropertyFeatureImages($property_feature_id){
        $propertyFeatureImages = PropertyFeatureImage::find()->where(['fk_property_feature_id'=>$property_feature_id])->all();
        if($propertyFeatureImages){
            return $propertyFeatureImages;
        }
    }
    
    public function getStatus(){
      return  $this->_status==1?"On":"Off";
    }
}
