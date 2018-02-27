<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_location".
 *
 * @property integer $id
 * @property integer $fk_ward
 * @property string $location_name
 * @property string $location_desc
 *
 * @property Ward $fkWard
 * @property SubLocation[] $subLocations
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_ward','location_name'], 'required'],
            [['fk_ward'], 'integer'],
            [['location_desc'], 'string'],
            [['location_name'], 'string', 'max' => 200],
            [['fk_ward'], 'exist', 'skipOnError' => true, 'targetClass' => Ward1::className(), 'targetAttribute' => ['fk_ward' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_ward' => 'Ward',
            'location_name' => 'Location Name',
            'location_desc' => 'Location Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkWard()
    {
        return $this->hasOne(Ward1::className(), ['id' => 'fk_ward']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubLocations()
    {
        return $this->hasMany(SubLocation::className(), ['fk_location' => 'id']);
    }
    public static function getLocationSearchOptions(){
        $return = [];
        //start with counties
        $counties = County::find()->all();
        if($counties){
            foreach($counties as $county){
                $return['county:'.$county->id] = $county->county_name;
                //get all subcounties
                $subcounties = Subcounty::findAll(['fk_county'=>$county->id]);  // $county->getSubcounties();
                if($subcounties){
                    foreach($subcounties as $subcounty){
                        $return['subcounty:'.$subcounty->id] = $subcounty->subcounty_name;
                        //get all wards
                        $wards = Ward::findAll(['fk_subcounty'=>$subcounty->id]); 
                        if($wards){
                            foreach($wards as $ward){
                                $return['ward:'.$ward->id] = $ward->ward_name;
                                //get all locations
                                $locations = Location::findAll(['fk_ward'=>$ward->id]);  
                                if($locations){
                                    foreach($locations as $location){
                                        $return['location:'.$location->id] = $location->location_name;
                                        //get all sublocations
                                        $sublocations = SubLocation::findAll(['fk_location'=>$location->id]);  
                                        if($sublocations){
                                            foreach($sublocations as $sublocation){
                                                $return['sublocation:'.$sublocation->id] = $sublocation->sub_loc_name;
                                                //get all estates
                                                $estates = Estate::findAll(['fk_sub_location'=>$sublocation->id]);  
                                                if($estates){
                                                    foreach($estates as $estate){
                                                        $return['estate:'.$estate->id] = $estate->estate_name;
                                                    }
                                                }

                                            }
                                        }

                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        return $return;
    }
}
