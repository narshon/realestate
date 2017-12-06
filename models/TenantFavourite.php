<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_tenant_favourite".
 *
 * @property integer $id
 * @property integer $fk_property_id
 * @property integer $fk_tenant_id
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Property $fkProperty
 * @property Tenant $fkTenant
 */
class TenantFavourite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_tenant_favourite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_property_id', 'fk_tenant_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
            [['fk_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['fk_property_id' => 'id']],
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
            'fk_property_id' => 'Fk Property ID',
            'fk_tenant_id' => 'Fk Tenant ID',
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
    public function getFkProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'fk_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTenant()
    {
        return $this->hasOne(Tenant::className(), ['id' => 'fk_tenant_id']);
    }
}
