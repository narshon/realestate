<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_management".
 *
 * @property integer $id
 * @property integer $fk_user_id
 * @property integer $management_type
 * @property string $location
 * @property string $address
 * @property string $profile_desc
 * @property integer $featured_property
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 * @property integer $_status
 *
 * @property Advert[] $adverts
 * @property Property $featuredProperty
 * @property SysUsers $fkUser
 * @property Property[] $properties
 * @property Property[] $properties0
 */
class Management extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
	[['fk_user_id', 'location','management_name','featured_property'], 'required'],
            [['fk_user_id', 'management_type', 'featured_property', 'created_by', 'modified_by', '_status'], 'integer'],
            [['location', 'address', 'profile_desc'], 'string'],
            [['date_created', 'date_modified','management_name'], 'safe'],
            [['featured_property'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['featured_property' => 'id']],
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
            'management_type' => 'Management Type',
            'location' => 'Location',
            'address' => 'Address',
            'profile_desc' => 'Profile Desc',
            'featured_property' => 'Featured Property',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
            '_status' => 'Status',
            'management_name' => 'Management Name'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['advert_owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeaturedProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'featured_property']);
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getfkUser()
    {
        return $this->hasOne(SysUsers::className(), ['id' => 'fk_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties0()
    {
        return $this->hasMany(Property::className(), ['management_id' => 'id']);
    }
	
	public function getManagementType(){
		
		$one = Lookup::findOne(['category'=>2,'_key'=>$this->management_type]);
        
        if($one){
            return $one->_value;
        }
	}
        
    public static function getAgentTitle(){
        $agent_name = Yii::$app->user->identity->fkManagement->management_name;
        $username = Yii::$app->user->identity->username;
        return "<h2>Welcome To ".$agent_name."</h2> Hi  $username";
        
    }
     public static function getManagementOptions(){
		$all = Estate::find()->all();
		$return = [];
		if($all){
			foreach($all as $model){
				$return[$model->id] = $model-> management_name;
			}
		}
		return $return;
		
		}
                
}
