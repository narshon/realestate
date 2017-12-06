<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_advert_feature".
 *
 * @property integer $id
 * @property integer $fk_advert_id
 * @property integer $fk_feature_id
 * @property string $feature_narration
 * @property string $image1
 * @property string $image2
 * @property string $image3
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Feature $fkFeature
 * @property Advert $fkAdvert
 */
class AdvertFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_advert_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_advert_id', 'fk_feature_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['feature_narration', 'image1', 'image2', 'image3'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['fk_feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feature::className(), 'targetAttribute' => ['fk_feature_id' => 'id']],
            [['fk_advert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Advert::className(), 'targetAttribute' => ['fk_advert_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_advert_id' => 'Fk Advert ID',
            'fk_feature_id' => 'Fk Feature ID',
            'feature_narration' => 'Feature Narration',
            'image1' => 'Image1',
            'image2' => 'Image2',
            'image3' => 'Image3',
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
    public function getFkFeature()
    {
        return $this->hasOne(Feature::className(), ['id' => 'fk_feature_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkAdvert()
    {
        return $this->hasOne(ForSale::className(), ['id' => 'fk_advert_id']);
    }
}
