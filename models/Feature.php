<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_feature".
 *
 * @property integer $id
 * @property string $feature_name
 * @property string $feature_desc
 * @property integer $created_by
 * @property string $date_created
 * @property integer $modified_by
 * @property string $date_modified
 *
 * @property AdvertFeature[] $advertFeatures
 * @property SysUsers $modifiedBy
 * @property SysUsers $createdBy
 * @property Preference[] $preferences
 * @property PropertyFeature[] $propertyFeatures
 */
class Feature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['feature_name'], 'required'],
            [['feature_desc'], 'string'],
            [['created_by', 'modified_by'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
            [['feature_name'], 'string', 'max' => 200],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => SysUsers::className(), 'targetAttribute' => ['modified_by' => 'id']],
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
            'feature_name' => 'Feature Name',
            'feature_desc' => 'Feature Desc',
            'created_by' => 'Created By',
            'date_created' => 'Date Created',
            'modified_by' => 'Modified By',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertFeatures()
    {
        return $this->hasMany(AdvertFeature::className(), ['fk_feature_id' => 'id']);
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
    public function getCreatedBy()
    {
        return $this->hasOne(SysUsers::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreferences()
    {
        return $this->hasMany(Preference::className(), ['fk_feature' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatures()
    {
        return $this->hasMany(PropertyFeature::className(), ['fk_feature' => 'id']);
    }
}
