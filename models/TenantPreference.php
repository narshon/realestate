<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_tenant_preference".
 *
 * @property integer $id
 * @property integer $fk_tenant_id
 * @property integer $fk_pref_id
 * @property string $pref_notes
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Preference $fkPref
 * @property Tenant $fkTenant
 */
class TenantPreference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_tenant_preference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_tenant_id', 'fk_pref_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['pref_notes'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['fk_pref_id'], 'exist', 'skipOnError' => true, 'targetClass' => Preference::className(), 'targetAttribute' => ['fk_pref_id' => 'id']],
            [['fk_tenant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tenant::className(), 'targetAttribute' => ['fk_tenant_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_tenant_id' => 'Fk Tenant ID',
            'fk_pref_id' => 'Fk Pref ID',
            'pref_notes' => 'Pref Notes',
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
    public function getFkPref()
    {
        return $this->hasOne(Preference::className(), ['id' => 'fk_pref_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTenant()
    {
        return $this->hasOne(Tenant::className(), ['id' => 'fk_tenant_id']);
    }
}
