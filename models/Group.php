<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_group".
 *
 * @property integer $id
 * @property string $group_name
 * @property integer $_status
 *
 * @property SysUsers[] $sysUsers
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['group_name'], 'required'],
            [['_status'], 'integer'],
            [['group_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => 'Group Name',
            '_status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysUsers()
    {
        return $this->hasMany(SysUsers::className(), ['fk_group_id' => 'id']);
    }
    
    public static function getLandlordID(){
        $model = Self::find()->where(['group_name'=>"Landlord"])->one();
        if($model){
            return $model->id;
        }
    }
    public static function getTenantID(){
		$model = Self::find()->where(['group_name'=>"Tenant"])->one();
        if($model){
            return $model->id;
        }
	}
	public static function getAgentusersID(){
	 $model = Self::find()->where(['group_name'=>"Agent"])->one();
            if($model){
                return $model->id;
            }
	}
}
