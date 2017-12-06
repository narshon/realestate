<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_advert".
 *
 * @property integer $id
 * @property string $advert_name
 * @property string $advert_desc
 * @property integer $advert_owner_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $_status
 * @property integer $advert_fee
 * @property string $image1
 * @property string $image2
 * @property string $image3
 * @property string $image4
 * @property string $image5
 * @property string $contact_details
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property SysUsers $modifiedBy
 * @property Management $advertOwner
 * @property SysUsers $createdBy
 * @property AdvertFeature[] $advertFeatures
 */
class ForSale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_advert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['advert_desc', 'image1', 'image2', 'image3', 'image4', 'image5', 'contact_details'], 'string'],
            [['advert_owner_id', '_status', 'advert_fee', 'created_by', 'modified_by'], 'integer'],
            [['start_date', 'end_date', 'date_created', 'date_modified'], 'safe'],
            [['advert_name'], 'string', 'max' => 200],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => SysUsers::className(), 'targetAttribute' => ['modified_by' => 'id']],
            [['advert_owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Management::className(), 'targetAttribute' => ['advert_owner_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => SysUsers::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'advert_name' => 'Advert Name',
            'advert_desc' => 'Advert Desc',
            'advert_owner_id' => 'Advert Owner ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            '_status' => 'Status',
            'advert_fee' => 'Advert Fee',
            'image1' => 'Image1',
            'image2' => 'Image2',
            'image3' => 'Image3',
            'image4' => 'Image4',
            'image5' => 'Image5',
            'contact_details' => 'Contact Details',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(SysUsers::className(), ['id' => 'modified_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertOwner()
    {
        return $this->hasOne(Management::className(), ['id' => 'advert_owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(SysUsers::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertFeatures()
    {
        return $this->hasMany(AdvertFeature::className(), ['fk_advert_id' => 'id']);
    }
    
    public function beforeSave($insert='insert') {
        
        if (parent::beforeSave($insert)) { 
            
            $this->start_date = date('Y-m-d', strtotime($this->start_date));
            $this->end_date = date('Y-m-d', strtotime($this->end_date));
            
            return true;
        } 
        else { 
            return false; 
            
        }
    }
    
    public function afterFind()
    {
        parent::afterFind();
        
        $this->start_date = date('d-m-Y', strtotime($this->start_date));
        $this->end_date = date('d-m-Y', strtotime($this->end_date));
        
        
    }
}
