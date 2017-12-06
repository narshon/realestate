<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_tenant".
 *
 * @property integer $id
 * @property integer $fk_user_id
 * @property string $tenant_desc
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 * @property integer $_status
 *
 * @property Occupancy[] $occupancies
 * @property SysUsers $fkUser
 * @property TenantFavourite[] $tenantFavourites
 * @property TenantPreference[] $tenantPreferences
 */
class Tenant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_tenant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_user_id', 'created_by', 'modified_by', '_status'], 'integer'],
            [['tenant_desc'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['fk_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => SysUsers::className(), 'targetAttribute' => ['fk_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_user_id' => 'Username',
            'tenant_desc' => 'Tenant Desc',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
            '_status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancies()
    {
        return $this->hasMany(Occupancy::className(), ['fk_tenant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(SysUsers::className(), ['id' => 'fk_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenantFavourites()
    {
        return $this->hasMany(TenantFavourite::className(), ['fk_tenant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenantPreferences()
    {
        return $this->hasMany(TenantPreference::className(), ['fk_tenant_id' => 'id']);
    }
    
    public static function getTenantOptions(){
        $array = [];
        $tenants = Tenant::find()->where(['_status'=>1])->all();
        if($tenants){
            foreach($tenants as $tenant){
                $array[$tenant->id] = $tenant->fkUser->username;
            }
        }
        
        return $array;
    }
}
