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
 * @property Property $fkProperty
 * @property PropertySublet $fkSublet
 * @property SysUsers $fkUser
 * @property OccupancyIssue[] $occupancyIssues
 * @property OccupancyPayments[] $occupancyPayments
 * @property OccupancyRent[] $occupancyRents
 * @property OccupancyTerm[] $occupancyTerms
 */
class Occupancy extends \yii\db\ActiveRecord
{
    public $payments_pool;
    public $sorted = [];
    public $phone;
    public $email;
    public $id_number;
    public $name1;
    public $name2;
    public $name3;
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
            [['notes','name1','name2','name3','phone', 'email','id_number'], 'string'],
            [['fk_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['fk_property_id' => 'id']],
            [['fk_sublet_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertySublet::className(), 'targetAttribute' => ['fk_sublet_id' => 'id']],
            [['fk_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['fk_user_id' => 'id']],
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
    public function getFkUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'fk_user_id']);
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
    
    public static function getDetail($id, $item)
    {
        if(($model = Occupancy::findOne($id)) !== null) {
            switch($item)
            {
                case 'property':
                    return $model->fkProperty->property_name;
                    break;
                case 'sublet':
                    return $model->fkSublet->sublet_name;
                    break;
                case 'name':
                    return $model->fkUsers->getNames();
                    break;
                default:
                    break;
            }
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
                if($occupant->id == 16 && $occupant->fk_property_id == 5)
                {
                    $test = 0;
                }
                //get all generic terms and invoke their action handlers
                $terms = Term::find()->where(['_status'=>1])->all();
                if($terms){
                    $transaction = \yii::$app->db->beginTransaction();
                    try {
                        $insertIds = [];
                    foreach($terms as $term){
                        $handler = $term->actionhandler;
                        //call the actions
                        if($handler){
                        $check = $occupant->$handler($term);
                            if($check===false){
                                throw new Exception('An Error Occured');
                            }elseif($check===99)
                            {
                                $test = 0;
                                $insertIds[] = Yii::$app->db->getLastInsertID();
                                
                            }
                        }
                    }
                    $transaction->commit();
                    if(count($insertIds)){
                        $occupant->createInvoice($insertIds, 'INV-' . $occupant->id . '-' . $term->id);
                    }
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                    }
                }
            }
        }
        
        
        return "Done!";
    }
    
    public static function calculateDisbursements(){
        //get occupants that are active
        $occupants = Self::find()->where(['_status'=>1])->all();
        if($occupants){
            foreach($occupants as $occupant){
                
                    $transaction = \yii::$app->db->beginTransaction();
                    try {
                        $insertIds = [];
                        
                        //check if the term is ready for this month for this occupant to disburse funds.
                        $property_id = $occupant->fk_property_id;
                        $term = $occupant->getDisbursementTerm();
                        
                        
                        if($term){
                            $termvalue = $term->term_value;
                            //check if there is an active occupant term for this.
                            $occupantTerm = OccupancyTerm::find()->where(['fk_occupancy_id'=>$occupant->id,'fk_property_term_id'=>$term->id,'_status'=>1])->one();
                            if($occupantTerm){
                                $termvalue = $occupantTerm->value;
                            }
                            $month = date('m');
                            $year = date('Y');
                            $date = date('d');
                            //check if we can proceed.
                            if($termvalue <= $date){
                                //get the rent bill to be disbursed.
                                 $rentbill = OccupancyRent::find()->where(['fk_occupancy_id'=>$occupant->id,'fk_term'=>Term::getRentTermID(),'month'=>$month,'year'=>$year,'_status'=>1])->one();
                                if($rentbill){
                                    //check if we haven't already disbursed for this bill.
                                    $check = Disbursements::find()->where(['fk_occupancy_rent'=>$rentbill->id,'month'=>$month, 'year'=>$year])->one();
                                    if(!$check){
                                     //proceed to raise this disbursement
                                      if(Disbursements::raise($occupant, $rentbill,$month, $year)){
                                       //successfully disbursed.
                                       $insertIds[] = Yii::$app->db->getLastInsertID();
                                     }  
                                   }
                                   
                                }
                            }
                            
                        }
                        

                        $transaction->commit();
                        if(count($insertIds)){
                          //  $occupant->createInvoice($insertIds, 'INV-' . $occupant->id . '-' . $term->id);
                        }
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                    }
                }
        }
        
        
        return "Done!";
    }
    
    private function getDisbursementTerm(){
        $property_id = $this->fk_property_id;
        $term_id = Term::getDisbursementTermID();
        //check if this property has implemented this term.
        $propertyTerm = PropertyTerm::find()->where(['fk_property_id'=>$property_id, 'fk_term_id'=>$term_id,'_status'=>1])->one();
        if($propertyTerm){
            
            return $propertyTerm;
        }
        else{
            return false;
        }
    }
    
    public function LandlordDisbursement($term){
        
        return true;
    }
    
    private function createInvoice($ids, $number)
    {
        foreach($ids as $id)
        {
            $model = new OccupancyInvoice();
            $model->fk_occupancy_rent = $id;
            $model->invoice_no = $number;
            $model->created_by = \yii::$app->user->identity->id;
            $model->created_on  = date('Y-m-d');
            $model->save();
        }
    }
    
    //Action specific functions to calculate bills.
    public function DateRentPay($term){
       
        //check if rent is due for this tenant and we have not posted the bill.
        //get current month and check if it's ready for calculation.
        $month = date('m');
        $year = date('Y');
        $date = date('d');
        if(($source = Source::findOne(['source_name' => 'Rent'])) !== null) {
            return $this->generateBill($term, $source->id, ['month'=>$month,'year'=>$year]);
        }
    }
    
    
    public function RentDeposit($term){
        if(($source = Source::findOne(['source_name' => 'Rent Deposit'])) !== null) {
            return $this->generateBill($term, $source->id);
        }
    }
    public function WaterDeposit($term){
        if(($source = Source::findOne(['source_name' => 'Water Deposit'])) !== null) {
            return $this->generateBill($term, $source->id);
        }
    }
    public function ElectricityDeposit($term){
        if(($source = Source::findOne(['source_name' => 'Electricity Deposit'])) !== null) {
            return $this->generateBill($term, $source->id);
        }
    }
    public function WaterBills($term){
         $month = date('m');
        $year = date('Y');
        $date = date('d');
        if(($source = Source::findOne(['source_name' => 'Water Bill'])) !== null) {
            return $this->generateBill($term, $source->id, ['month'=>$month,'year'=>$year]);
        }
    }
    public function ElectricityBills($term){
         $month = date('m');
        $year = date('Y');
        $date = date('d');
        if(($source = Source::findOne(['source_name' => 'Electricity Bill'])) !== null) {
            return $this->generateBill($term, $source->id, ['month'=>$month,'year'=>$year]);
        }
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
    
    private function generateBill($term,$source_id, $conditions = null)
    {
       
        if(($bill = OccupancyRent::findOne(is_array($conditions) ? array_merge($conditions, ['fk_occupancy_id' => $this->id, 'fk_source'=>$source_id]) : ['fk_occupancy_id' => $this->id, 'fk_source'=>$source_id])) === null) {
            if($this->checkIfTermIsActive($term->id)) {
                return $this->billTerm($term->id, $source_id, true);
            }
        }
    }
    
    private function checkIfTermIsActive($term_id)
    {
        if(($term = PropertyTerm::findOne(['fk_property_id' => $this->fk_property_id, 'fk_term_id'=>$term_id, '_status' => 1])) !== null) {
            if(isset($term->frequency)) {
                switch ($term->frequency)
                {
                    case 'yearly':
                        $start = $this->GetBillStartTime();
                        $today = new \DateTime();
                        $interval = $today->diff($start);
                        $start->modify('+ '. $interval->y . ' years');
                        return $start > $today;
                    case 'monthly':
                    case 'once':
                    default:
                        return true;
                }
            }
            else {
                return true;
            }
        }
        return false;
    }
    
    private function GetBillStartTime()
    {
        if(isset($this->fkOccupancyTerm->date_signed)){
            return new \DateTime($this->fkOccupanyTerm->date_signed);
        }elseif(isset($this->start_date)){
            return new \DateTime($this->start_date);
        }else {
            
        }
    }
    
    private function billTerm($term_id, $source, $new_bill)
    {
        if($new_bill) {
            $model = new OccupancyRent();
            $model->fk_source = $source;
            $model->fk_occupancy_id = $this->id;
            $model->month = date('m');
            $model->year = date('Y');
            $model->fk_term = $term_id;
            $model->amount = $this->getBillAmount($term_id);
            $status = \app\models\Lookup::findOne(['_value' => 'Unmatched', 'category'=>6]);
            $model->_status = $status ? $status->_key : 0;
            return ($model->save()) ? 99 : false;
        }
    }
    public function getBillAmount($term_id)
    {
        if(($propertyTerm = PropertyTerm::findOne(['fk_property_id' => $this->fk_property_id, 'fk_term_id'=>$term_id, '_status' => 1])) !== null) {
            if(($occupancyTerm = OccupancyTerm::findOne(['fk_occupancy_id' => $this->id, 'fk_property_term_id' => $propertyTerm->id])) !== null) {
                return $occupancyTerm->value;
            }else
            {
                return $propertyTerm->term_value;
            }
        }else
        {
            return 0;
        }
    }
    
    public function generateStatement($start = false, $end = false)
    {
        $start_date = isset($start) ? new \DateTime($start) : new \DateTime('2000-01-01');
        $end_date = isset($end) ? new \DateTime($end) : new \DateTime();
        $payments = Occupancy::find()
            ->where(['fk_occupancy' => $this->id, 'status' => 1])
            ->andWhere(['between','payment_date', [$start_date->format('Y-m-d'), $end_date->format('Y-m-d')]])
            ->all();
        $bills = OccupancyRent::find()
            ->where(['fk_occupancy' => $this->id]);
        
    }
    
    public function getFindTenantQueryString(){
        $queryString = '';
        
        if($this->email != ''){
            $queryString .= "email = '$this->email' OR ";
        }
        if($this->phone != ''){
            $queryString .= "phone = '$this->phone' OR ";
        }
        if($this->id_number != ''){
            $queryString .= "id_number= '$this->id_number' OR ";
        }
        if($this->name1 != ''){
            $queryString .= "name1 LIKE '%$this->name1%' OR ";
        }
        if($this->name2 != ''){
            $queryString .= "name2 LIKE '%$this->name2%' OR ";
        }
        if($this->name3 != ''){
            $queryString .= "name3 LIKE '%$this->name3%'";
        }
        //check if the last chars is OR
        $check = substr($queryString, -4);
        if($check == ' OR '){
            $queryString = substr($queryString, 0, -4);
        }
        return $queryString;
    }
    public function getUnallocatedPayments()
    {
        $allocated = OccupancyRent::find()
            ->select('amount')
            ->where(['fk_occupancy_id' => $this->id])
            ->andWhere(['_status' => 1])
            ->sum('amount');
        $payments = OccupancyPayments::find()
            ->select('amount')
            ->where(['fk_occupancy_id' => $this->id])
            ->andWhere(['status' => 2])
            ->sum('amount');
        
        $this->payments_pool = $payments - $allocated;
    }
    
    public function clearBills($bills, $status)
    {
        foreach($bills as $bill) {
            if(($model = OccupancyRent::findOne($bill)) !== null) {
                $model->_status = $status;
                $model->save(false);
            }
        }
    }
    public function getTenantName(){
        return $this->fkUsers->getNames();
    }
}
