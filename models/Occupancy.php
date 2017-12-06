<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_occupancy".
 *
 * @property integer $id
 * @property integer $fk_property_id
 * @property integer $fk_sublet_id
 * @property integer $fk_user_id
 * @property string $start_date
 * @property string $end_date
 * @property string $notes
 * @property integer $_status
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property Tenant $fkTenant
 * @property Property $fkProperty
 * @property PropertySublet $fkSublet
 * @property OccupancyIssue[] $occupancyIssues
 * @property OccupancyRent[] $occupancyRents
 * @property OccupancyTerm[] $occupancyTerms
 */
class Occupancy extends \yii\db\ActiveRecord
{
    public $phone;
    public $email;
    public $id_number;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_property_id', 'fk_sublet_id', 'fk_user_id', '_status'], 'required'],
            [['fk_property_id', 'fk_sublet_id', 'fk_user_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['start_date', 'end_date', 'date_created', 'date_modified'], 'safe'],
            [['notes','phone','email','id_number'], 'string'],
            [['fk_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['fk_user_id' => 'id']],
            [['fk_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['fk_property_id' => 'id']],
            [['fk_sublet_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertySublet::className(), 'targetAttribute' => ['fk_sublet_id' => 'id']],
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
            'fk_sublet_id' => 'Sublet',
            'fk_user_id' => 'Tenant',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'notes' => 'Notes',
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
    public function getFkTenant()
    {
        return $this->hasOne(Users::className(), ['id' => 'fk_user_id']);
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
    public function getFkSublet()
    {
        return $this->hasOne(PropertySublet::className(), ['id' => 'fk_sublet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyIssues()
    {
        return $this->hasMany(OccupancyIssue::className(), ['fk_occupancy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyRents()
    {
        return $this->hasMany(OccupancyRent::className(), ['fk_occupancy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyTerms()
    {
        return $this->hasMany(OccupancyTerm::className(), ['fk_occupancy_id' => 'id']);
    }
    
     public function afterFind()
    {

        parent::afterFind();
        if($this->start_date)
        $this->start_date = date('d-m-Y', strtotime($this->start_date));
        if($this->end_date)
        $this->end_date = date('d-m-Y', strtotime($this->end_date));

    }
    
    public function beforeSave($insert='insert') {
        
        if (parent::beforeSave($insert)) { 
            if($this->start_date)
            $this->start_date = date('Y-m-d', strtotime($this->start_date));
            if($this->end_date)
             $this->end_date = date('Y-m-d', strtotime($this->end_date));
            
            return true;
        } 
        else { 
            return false; 
            
        }
    }
    
    public static function getOccupancyOptions(){
        $array = [];
        $occupancies = Occupancy::find()->where(['_status'=>1])->all();
        if($occupancies){
            foreach($occupancies as $occupancy){
                $array[$occupancy->id] = $occupancy->fkProperty->property_name.'_'.$occupancy->fkSublet->sublet_name;
            }
        }
        
        return $array;
    }
    
    public function getStatus(){
            if($this->_status == 1){
                return "OFF";
            }
            if($this->_status == 2){
                return "ON";
            }
    }
    
    public static function calculateBills(){
        
        //get occupants that are active
        $occupants = Self::find()->where(['_status'=>1])->all();
        if($occupants){
            foreach($occupants as $occupant){
                //get all generic terms and invoke their action handlers
                $terms = Term::find()->where(['_status'=>1])->all();
                if($terms){
                    
                    foreach($terms as $term){
                        $handler = $term->actionhandler;
                        //call the actions
                        if($handler){ 
                            $check = $occupant->$handler($term);
                            if(!$check){
                                return false;
                            }
                            
                        }
                    }
                }
            }
        }
        
        
        return "Done!";
    }
    
    //Action specific functions to calculate bills.
    public function DateRentPay($term){
       
        //check if rent is due for this tenant and we have not posted the bill.
        //get current month and check if it's ready for calculation.
        $month = date('m');
        $year = date('Y');
        $date = date('d');
        $rent = OccupancyRent::find()->where(['fk_occupancy_id'=>$this->id,'month'=>$month,'year'=>$year])->one();
        
        if(!$rent){  
            
            //check if it's the right time now to post this rent.
              //let's check the property term for this issue and check whether we have a occupancy term as well. We shall begin with occupancy term.
              $property = $this->fkProperty;
              $propertyterm = PropertyTerm::find()->where(['fk_term_id'=>$term->id,'_status'=>1,'fk_property_id'=>$property->id])->one();
              if($propertyterm){
              $term_value = PropertyTerm::getTermValue($term->id,$property->id,$this->id);
                 
                if($term_value <= $date){
                    //we can now post this bill.
                    $bill = new OccupancyRent();
                    $bill->fk_occupancy_id = $this->id;
                    $bill->fk_source = Source::getMonthlyRentID();
                    $bill->month = $month;
                    $bill->year = $year;
                    $bill->amount = PropertyTerm::getTermValue(Term::getRentTermID(),$this->fk_property_id,$this->id);
                    $bill->_status = 1; //pending
                    if($bill->save(false)){
                        return true;
                    }
                }
              }
        }
        return true;
    }
    
    public function LandlordDisbursement($term){
        return true;
    }
    public function RentDeposit($term){
        return true;
    }
    public function WaterDeposit($term){
        return true;
    }
    public function ElectricityDeposit($term){
        return true;
    }
    public function WaterBills($term){
        return true;
    }
    public function ElectricityBills($term){
        return true;
    }
    public function PenatlyDate($term){
        return true;
    }
    public function PenaltyPercentage($term){
        return true;
    }
    public function RentDueDate($term){
        return true;
    }
    public function AgentCommission($term){
        return true;
    }

}
