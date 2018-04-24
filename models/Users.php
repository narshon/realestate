<?php

namespace app\models;

use Yii;

use yii\web\IdentityInterface;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "sys_users".
 *
 * @property integer $id
 * @property integer $fk_group_id
 * @property string $username
 * @property string $pass
 * @property string $name1
 * @property string $name2
 * @property string $name3
 * @property integer $age
 * @property string $email
 * @property string $phone
 * @property string $occupation
 * @property string $employer
 * @property string $address
 * @property string $date_added
 * @property string $gender
 * @property string $color_code
 * @property string $icon_id
 * @property string $residence 
 *
 * @property Advert[] $adverts
 * @property Advert[] $adverts0
 * @property Blog[] $blogs
 * @property Feature[] $features
 * @property Feature[] $features0
 * @property PropertyFeatureImage[] $propertyFeatureImages
 * @property PropertyFeatureImage[] $propertyFeatureImages0
 * @property Tenant[] $tenants
 * @property Group $fkGroup
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    
    public $confirm_pass;
    public $authKey;
    public $fk_sublet_id;
	public $confirmpass;
    public $selected_property;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_group_id','fk_management_id','name1','name3','phone'], 'required'],
            [['fk_group_id', 'age','fk_management_id'], 'integer'],
            [['fk_group_id', 'age'], 'integer'],
            [['address','county','subcounty','ward','location'], 'string'],
            [['date_added','id_number','fk_sublet_id'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['pass','confirm_pass','confirmpass'], 'string', 'max' => 100],
            [['name1', 'name2', 'name3','residence','occupation','employer'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 500],
            [['phone', 'color_code'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 10],
            [['icon_id'], 'string', 'max' => 11],
            [['phone','id_number','email'], 'unique'],
            [['fk_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['fk_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_group_id' => 'Fk Group ID',
            'username' => 'Username',
            'pass' => 'Pass',
            'name1' => 'Name1',
            'name2' => 'Name2',
            'name3' => 'Name3',
            'age' => 'Age',
            'email' => 'Email',
            'phone' => 'Phone',
            'occupation'=>'Occupation',
            'employer'=>'Employer',
            'address' => 'Address',
            'date_added' => 'Date Added',
            'gender' => 'Gender',
            'color_code' => 'Color Code',
            'icon_id' => 'Icon ID',
            'residence' => "Residence"
        ];
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
        if($this->isNewRecord){
            $this->date_added = date("Y-m-d H:i:s");
        }
        
          //hash the password
        if($this->confirmpass != ''){
            //check password
            $this->checkPasswords();
          $this->pass =  Yii::$app->getSecurity()->generatePasswordHash($this->pass); //md5($this->password);
        }
        
        
        if($this->hasErrors()){
              return false;
          }
          else{
            return true;
          }
    }
    
    public function checkPasswords(){
        if($this->pass === $this->confirmpass){
            return true;
        }
        else{
            $this->addError('pass', "Passwords do not match!"); //{$this->password} and Repeat: {$this->confirm_pass}
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['modified_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts0()
    {
        return $this->hasMany(Advert::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['fk_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatures()
    {
        return $this->hasMany(Feature::className(), ['modified_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatures0()
    {
        return $this->hasMany(Feature::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatureImages()
    {
        return $this->hasMany(PropertyFeatureImage::className(), ['modified_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatureImages0()
    {
        return $this->hasMany(PropertyFeatureImage::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenants()
    {
        return $this->hasMany(Tenant::className(), ['fk_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'fk_group_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkManagement()
    {
        return $this->hasOne(Management::className(), ['id' => 'fk_management_id']);
    }
  
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
         return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $users = self::find()->All();
        foreach ($users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $users = self::find()->All();
        foreach ($users as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }
    public static function findUserByEmail($email){
        
        $users = self::find()->All();
        foreach ($users as $user) {
            if (strcasecmp($user->email, $email) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {  
       //return $this->pass === $password;
       if (Yii::$app->getSecurity()->validatePassword($password, $this->pass)) {
           return true;
        } else {
            return false;
        }
    }
    
      public static function isAgent(){
        if(Yii::$app->user->isGuest){
            return false;
        }
        else{
            if(Yii::$app->user->identity->fkGroup->group_name == "Agent"){
                return true;
            }
            else{
                return false;
            }
        }
        
        
    }
    public static function isAdmin(){
         if(Yii::$app->user->isGuest){
            return false;
        }
        else{
            if(Yii::$app->user->identity->fkGroup->group_name == "Admin"){
                return true;
            }
            else{
                return false;
            }
        }
    }
    
    public static function getManagementID(){
        $id = Yii::$app->user->identity->fk_management_id;
        if(isset($id)){
            return Yii::$app->user->identity->fk_management_id;
        }
        else{
            return NULL;
        }
    }
    
    public function getNames(){
        return $this->name1.' '.$this->name2.' '.$this->name3;
        
    }
    public static function getStaticName($fk_user_id){
        $instance = Self::findone(['id'=>$fk_user_id]);
        if($instance){
            return $instance->name1.' '.$instance->name2.' '.$instance->name3;
        }
    }
    
    public function setOccupancylink($fk_sublet_id){
        
        $url = Url::to(['occupancy/setform','fk_sublet_id'=>$fk_sublet_id,'fk_user_id'=>$this->id]);
        return Html::a($this->name1.' '.$this->name2.' '.$this->name3,"#",['onclick'=>"ajaxUniversalGetRequest('$url','modal_body_div','', 1)",'class'=>"btn btn-default"]);
    }
	
	public static function getSearchQuery($searchModel, $group, $agency){
		$query = Users::find()->where(['fk_group_id'=>$group,'fk_management_id'=>$agency])->orderBy("id desc");
		
		if($searchModel->id != ""){
			$query->andWhere(['=', 'id', $searchModel->id]);
			//$query->addParams([":id"=>$searchModel->id, ':group'=>$group, ':agency'=>$agency]);
		}
		
		if($searchModel->name1 != ""){
			$query->andWhere(['LIKE', 'name1', $searchModel->name1]);
		}
		if($searchModel->name2 != ""){
			$query->andWhere(['LIKE', 'name2', $searchModel->name2]);
		}
		if($searchModel->name3 != ""){
			$query->andWhere(['LIKE', 'name3', $searchModel->name3]);
		}
		if($searchModel->email != ""){
			$query->andWhere(['LIKE', 'email', $searchModel->email]);
		}
		if($searchModel->phone != ""){
			$query->andWhere(['LIKE', 'phone', $searchModel->phone]);
		}
		if($searchModel->id_number != ""){
			$query->andWhere(['=', 'id_number', $searchModel->id_number]);
		}
		
		return $query;
	}
	
	public static function getSearchTenant($searchModel, $group, $tenant){
		$query = Users::find()->where(['fk_group_id'=>$group,'fk_management_id'=>$tenant])->orderBy("id desc");
		
		if($searchModel->id != ""){
			$query->andWhere(['=', 'id', $searchModel->id]);
			//$query->addParams([":id"=>$searchModel->id, ':group'=>$group, ':agency'=>$agency]);
		}
		
		if($searchModel->name1 != ""){
			$query->andWhere(['LIKE', 'name1', $searchModel->name1]);
		}
		if($searchModel->name2 != ""){
			$query->andWhere(['LIKE', 'name2', $searchModel->name2]);
		}
		if($searchModel->name3 != ""){
			$query->andWhere(['LIKE', 'name3', $searchModel->name3]);
		}
		if($searchModel->email != ""){
			$query->andWhere(['LIKE', 'email', $searchModel->email]);
		}
		if($searchModel->phone != ""){
			$query->andWhere(['LIKE', 'phone', $searchModel->phone]);
		}
		if($searchModel->id_number != ""){
			$query->andWhere(['=', 'id_number', $searchModel->id_number]);
		}
		
		return $query;
	}
        
public static function getUsersOptions(){
        $all = Users::find()->where(['fk_group_id'=> Group::getAgentusersID(),'fk_management_id'=> Users::getManagementID()])->all();
        $return = [];
        if($all)
        {
            foreach($all as $model){
                $return[$model->id] = $model->name1.' '.$model->name2.' '.$model->name3;
            }
        }
        
        return $return;
    }
    public function getAllOccupanciesList($active_only = false)
    {
        $list = [];
        $occupancies = Occupancy::findAll($active_only ? ['fk_user_id' => $this->id, '_status' => 1] : ['fk_user_id' => $this->id]);
        if(is_array($occupancies)) {
            foreach ($occupancies as $occupancy) {
                $list[$occupancy->id] = $occupancy->fkProperty->property_name . ' - ' . $occupancy->fkSublet->sublet_name;
            }
        }
        return $list;
    }
    public static function getDetail(array $details, $id)
    {
        $data = [];
        if(($model = Users::findOne($id)) !== null) {
            foreach ($details as $item) {
                $data[] = $model->$item;
            }
        }
        return $data;
    }
    
    public function getTenantName1Link(){
        return Html::a($this->name1,['tenantview','id'=>$this->id]);
    }
    public function getLandlordName1(){
        return Html::a($this->name1,['landlordview', 'id'=>$this->id]);
    }
}

