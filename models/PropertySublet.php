<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "re_property_sublet".
 *
 * @property integer $id
 * @property integer $fk_property_id
 * @property string $sublet_name
 * @property string $sublet_desc
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Occupancy[] $occupancies
 * @property PropertyFeature[] $propertyFeatures
 * @property Property $fkProperty
 */
class PropertySublet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_property_sublet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_property_id', 'sublet_name'], 'required'],
            [['fk_property_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['sublet_desc'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['sublet_name'], 'string', 'max' => 200],
            [['fk_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['fk_property_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_property_id' => 'Property',
            'sublet_name' => 'Sublet Name',
            'sublet_desc' => 'Sublet Desc',
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
    public function getOccupancies()
    {
        return $this->hasMany(Occupancy::className(), ['fk_sublet_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatures()
    {
        return $this->hasMany(PropertyFeature::className(), ['fk_sublet_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'fk_property_id']);
    }
    
    public static function getSubletsList($property_key){
        $return = [];
            
            //get the make of this key.
            $sublets = Self::find()->where(['fk_property_id'=>$property_key])->all();
            if($sublets){
                
                foreach($sublets as $sublet){
                    $return[] = ['id'=>$sublet->id,'sublet_name'=>$sublet->sublet_name];
                }
                
            }
            
            
            return $return;
    }
    
    public function getOccupant(){
        //check if we have an active occupancy on this sublet.
        $occupant = Occupancy::find()->where(['fk_property_id'=>$this->fk_property_id,'fk_sublet_id'=>$this->id,'_status'=>1])->one();
        if($occupant){
            return Html::a(Html::encode($occupant->fkTenant->getNames()), ['sys-users/tenantview', 'id' => $occupant->fk_user_id]);
        }
        else{
            $dh = new \app\utilities\DataHelper();
            $url = Url::to(['occupancy/set', 'fk_sublet_id' => $this->id]);
            return $dh->getModalButton(new \app\models\PropertySublet, 'occupancy/set', 'Find Tenant', 'btn btn-success btn-sm','Set',$url); 
        }
    }
    public static function getPropertyID($fk_sublet_id){
        $instance = Self::findone(['id'=>$fk_sublet_id]);
        if($instance){
            return $instance->fk_property_id;
        }
    }
    public static function getSubletName($fk_sublet_id){
        $instance = Self::findone(['id'=>$fk_sublet_id]);
        if($instance){
            return $instance->sublet_name;
        }
    }
}
