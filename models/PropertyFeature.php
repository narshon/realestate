<?php

namespace app\models;

use Yii;
use app\models\PropertyFeatureImage;

/**
 * This is the model class for table "re_property_feature".
 *
 * @property integer $id
 * @property integer $fk_feature
 * @property integer $fk_property_id
 * @property integer $fk_sublet_id
 * @property string $feature_narration
 * @property string $feature_video_url
 * @property integer $_status
 * @property integer $created_by
 * @property string $date_created
 * @property integer $modified_by
 * @property string $date_modified
 *
 * @property Feature $fkFeature
 * @property Property $fkProperty
 * @property PropertySublet $fkSublet
 * @property PropertyFeatureImage[] $propertyFeatureImages
 */
class PropertyFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_property_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_feature', 'fk_property_id', 'fk_sublet_id'], 'required'],
            [['fk_feature', 'fk_property_id', 'fk_sublet_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['feature_narration', 'feature_video_url'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['fk_feature'], 'exist', 'skipOnError' => true, 'targetClass' => Feature::className(), 'targetAttribute' => ['fk_feature' => 'id']],
            [['fk_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['fk_property_id' => 'id']],
            [['fk_sublet_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertySublet::className(), 'targetAttribute' => ['fk_sublet_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_feature' => 'Feature',
            'fk_property_id' => 'Property',
            'fk_sublet_id' => 'Sublet',
            'feature_narration' => 'Feature Narration',
            'feature_video_url' => 'Feature Video Url',
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
    public function getFkFeature()
    {
        return $this->hasOne(Feature::className(), ['id' => 'fk_feature']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'fk_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkSublet()
    {
        return $this->hasOne(PropertySublet::className(), ['id' => 'fk_sublet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatureImages()
    {
        return $this->hasMany(PropertyFeatureImage::className(), ['fk_property_feature_id' => 'id']);
    }
    
    public static function getFeaturedImage($property_id){
        
        $baseUrl = Yii::$app->request->BaseUrl;
        $ids = [];
        $features = PropertyFeature::find()->where(['fk_property_id'=>$property_id])->all();
        if($features){
            foreach($features as $feature){
                $ids[]=$feature->id;
            }
            //query feature images and get the one that's promoted to the frontpage.
            $image = PropertyFeatureImage::find()
                    ->where(
                            'fk_property_feature_id IN ('.  implode(',', $ids).') && _status = 2 '
                      )->one();
            if($image){
                return $baseUrl.'/uploads/'.$image->image_url;
            }
           
            
        }
        
        return $baseUrl.'/images/home.jpg';
        
    }
    
}