<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_preference".
 *
 * @property integer $id
 * @property integer $fk_feature
 * @property string $preference_title
 * @property string $preference_desc
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Feature $fkFeature
 * @property TenantPreference[] $tenantPreferences
 */
class Preference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_preference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_feature', '_status', 'preference_title'], 'required'],
            [['fk_feature', '_status', 'created_by', 'modified_by'], 'integer'],
            [['preference_desc'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['preference_title'], 'string', 'max' => 200],
            [['fk_feature'], 'exist', 'skipOnError' => true, 'targetClass' => Feature::className(), 'targetAttribute' => ['fk_feature' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_feature' => 'Fk Feature',
            'preference_title' => 'Preference Title',
            'preference_desc' => 'Preference Desc',
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
        return $this->hasOne(Feature::className(), ['id' => 'fk_feature']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenantPreferences()
    {
        return $this->hasMany(TenantPreference::className(), ['fk_pref_id' => 'id']);
    }
}
