<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use app\models\PropertyArea;
use app\models\PropertyTerm;

/**
 * This is the model class for table "re_property".
 *
 * @property integer $id
 * @property string $property_name
 * @property string $property_desc
 * @property string $property_location
 * @property integer $property_type
 * @property integer $management_id
 * @property integer $owner_id
 * @property integer $_status
 * @property string $property_video_url
 * @property integer $created_by
 * @property string $date_created
 * @property integer $modified_by
 * @property string $date_modified
 *
 * @property Management[] $managements
 * @property Occupancy[] $occupancies
 * @property Management $owner
 * @property Lookup $propertyType
 * @property Management $management
 * @property PropertyFeature[] $propertyFeatures
 * @property PropertySublet[] $propertySublets
 * @property PropertyTerm[] $propertyTerms
 * @property TenantFavourite[] $tenantFavourites
 */
class Property extends \yii\db\ActiveRecord
{
    
    public $search_sub_location;
    public $search_price_range1;
    public $search_price_range2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_name'], 'required'],
            [['id', 'property_type', 'management_id', 'owner_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['property_desc', 'property_location', 'property_video_url'], 'string'],
            [['date_created', 'date_modified','search_sub_location','search_price_range1','search_price_range2'], 'safe'],
            [['property_name'], 'string', 'max' => 200],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Management::className(), 'targetAttribute' => ['owner_id' => 'id']],
            [['property_type'], 'exist', 'skipOnError' => true, 'targetClass' => Lookup::className(), 'targetAttribute' => ['property_type' => 'id']],
            [['management_id'], 'exist', 'skipOnError' => true, 'targetClass' => Management::className(), 'targetAttribute' => ['management_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property_name' => 'Property Name',
            'property_desc' => 'Property Desc',
            'property_location' => 'Property Location',
            'property_type' => 'Property Type',
            'management_id' => 'Management ID',
            'owner_id' => 'Owner ID',
            '_status' => 'Status',
            'property_video_url' => 'Property Video Url',
            'created_by' => 'Created By',
            'date_created' => 'Date Created',
            'modified_by' => 'Modified By',
            'date_modified' => 'Date Modified',
            'search_sub_location' => 'Location',
            'search_price_range1' => 'Price Range'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagements()
    {
        return $this->hasMany(Management::className(), ['featured_property' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancies()
    {
        return $this->hasMany(Occupancy::className(), ['fk_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Management::className(), ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyType()
    {
       //get the property type category.
      $type = LookupCategory::find()->where(['category_name'=>'Property Type'])->one();
       if($type){
           //get this property type.
           $propertytype = Lookup::find()->where(['_key'=>$this->property_type, 'category'=>$type->id])->one();
           if($propertytype){
               if(isset($propertytype->_value)){  
                 return ['Property Type'=>$propertytype->_value];
               }
           }
       }
       
       return [];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagement()
    {
        return $this->hasOne(Management::className(), ['id' => 'management_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyFeatures()
    {
        return $this->hasMany(PropertyFeature::className(), ['fk_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertySublets()
    {
        return $this->hasMany(PropertySublet::className(), ['fk_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyTerms()
    {
        return $this->hasMany(PropertyTerm::className(), ['fk_property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenantFavourites()
    {
        return $this->hasMany(TenantFavourite::className(), ['fk_property_id' => 'id']);
    }
    public function getFeatures(){
        /* we need specific features for the home page here only.
         * Price
         * Property Type
         * Estate
         * Sub-Location
         * 
         */
        //let's get the price of this property
        $price = PropertyTerm::getPrice($this->id);
        
        //get property_type of this property.
        $property_type = $this->getPropertyType();
        
        //get the estate and sub location
        $place = PropertyArea::getPlace($this->id);
        
        //get the estate and sub location
       // $Sublocation = PropertyArea::getPropertySublocation($this->id);
        
        return $price + $property_type + $place;
        
        
    }
    public function propertyPost(){
        
        $title = Html::a(Html::encode($this->property_name), ['property/view', 'id' => $this->id]);
        $url = \yii\helpers\Url::to(['property/view', 'id' => $this->id]);
        $propert_details = '';
        $propert_details .= '<ul class="list-group"> ';
        $propert_details  .= '<li class="list-group-item"><span class="property-desc"> '. $this->management->management_name.'</span></li>';
        $image = PropertyFeature::getFeaturedImage($this->id);
        $features = $this->getFeatures();  
        if($features){
            
            
            foreach($features as $key => $feature){
                //collect a few features for the interface e.g. type of house, no. rooms, roof-type e.t.c.
                $propert_details .= '<li class="list-group-item"> ';
                $propert_details .= '<span class="property_feature text-muted small"> <strong> '.$key.':  </strong> </span>';
                $propert_details .= '<span class="pull-right text-muted small">'.$feature.'</span></li>';
            }
            $propert_details .= '</ul>';
            $propert_details  .= '<span class="property-view-url pull-right"> <button type="button"  class="btn btn-sm btn-danger btn-property-view-url" onClick="window.location.replace(\''.$url.'\');">View</button> </span>';
            
        }
        
        //construct view
        $view = <<<VIEW
           <div class="panel panel-danger custompanel">
              <div class="panel-heading custompanelheading" style='width:100%;'>
                $title
            </div>
             <div class="panel-body custompanelbody">
                  <div class='panel-image'> <img class='img-property-icon' src='$image' ></img> </div>
                   
                    $propert_details
                </div>
            </div>
VIEW;
        echo $view;
        
    }
    
 
    
    
}
