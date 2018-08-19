<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Lookup;
use app\models\LookupCategory;
/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="print_area" class="row">
    <div class="row">
        <div class="col-md-12">
            <h3 class="reciept-agency-name" style="text-align: center">
                <strong><?= Html::encode(Yii::$app->user->identity->fkManagement->management_name) ?></strong>
            </h3>
           <h4 class="reciept-agency-desc" style="text-align: center; width:100%"> <i><?php echo Html::decode(Yii::$app->user->identity->fkManagement->address) ?></i> </h4>

       </div>
    </div> 
    <div class="row">
        <div class="col-xs-12 col-sm-12 receipt-text">
            <label>Receipt NO :</label><?= $model->fkReceipt->receipt_no ?> &nbsp;&nbsp;&nbsp;
            <label>House: </label><?=$model->fkOccupancy->fk_property_id.' '.$model->fkOccupancy->fkProperty->property_name." "."Sublet:".$model->fkOccupancy->fkSublet->sublet_name ?> &nbsp;&nbsp;&nbsp;
            <span class="receipt-text">  <label> DATE: <?=$model->payment_date?> </label> </span>
            <label>Payment Method: </label><?= Lookup::getLookupCategoryValue(LookupCategory::getLookupCategoryID("Payment Method"), $model->payment_method)   ?>
            <label>Payment Ref: </label><?= $model->ref_no ?> 
         </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12  receipt-text"> 
            <label>RECEIVED from: </label><?=$model->fkOccupancy->fkUsers->getNames()?>
            <label>The sum of shillings: </label><?php 
               echo $model->amount.": "; 
               $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
               echo $f->format($model->amount);

               ?>
        </div>
    </div>
    <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 receipt-table-text">
           <table id="t01">   
              <tr>
                <th>Item</th>
                <th>Period</th> 
                <th>Amount</th>
                
              </tr>
              <?php
              //start with cleared bills.
              $total_allocations = 0;
                $bills = $model->getMatchedBillItems();
                if($bills){
                    foreach($bills as $bill){
                      $term = isset($bill->fkOccupancyRent->fkTerm->term_name)?$bill->fkOccupancyRent->fkTerm->term_name:'';
                        echo <<<EOF
                        <tr>
                            <td>$term</td>
                            <td>{$bill->fkOccupancyRent->month}/{$bill->fkOccupancyRent->year}</td>
                            <td>{$bill->getAmountWithBal()}</td>
                      </tr>

EOF;
                    $total_allocations += $bill->amount;
                            
                    }
                }
                $balance = (double)$model->amount - $total_allocations;
                if($balance > 0){
                    echo <<<EOF
                        <tr>
                            <td>Unallocated Amount</td>
                            <td>-</td>
                            <td>{$balance}</td>
                      </tr>

EOF;
                }
                   
              ?>
            </table>
           </div> 
    </div>
           
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <span class="receipt-text"> REMARKS: </span>
                            <?php
                             //check for pending bills.
                            $pending_balance = 0; $periods = [];
                            $pendingBills = \app\models\OccupancyRent::find()->where(" fk_occupancy_id = $model->fk_occupancy_id AND (_status = 0 OR _status = 2)")->all();
                            if($pendingBills){
                                foreach($pendingBills as $pending){
                                 $pending_item = $pending->fkTerm->term_name;
                                 $pending_period = $pending->month;
                                 $pending_billed_amount = $pending->amount;
                                 $pending_amount_paid = '';
                                 //check if a payment exist on this bill
                                 $pendingPaid = \app\models\OccupancyPaymentsMapping::findone(['fk_occupancy_rent'=>$pending->id]);
                                 if($pendingPaid){
                                     $pending_amount_paid = $pendingPaid->amount;
                                 }
                                 $pending_balance += $pending_billed_amount - $pending_amount_paid;
                                 $dt = DateTime::createFromFormat('!m', $pending_period);
                                 $periods[$pending_period]= $dt->format('F');
                                 
                             }
                            } ksort($periods);
                                ?>
                            <small><?php echo implode(",", $periods) ?> Rent Balance = <?=  $pending_balance ?></small>
                            <span class="receipt-text" >Served By: <?= Yii::$app->user->identity->username ?> Signature:___________ </span>
                        </div>
			
		</div>
       <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11" align=" center"><small>Printed on: <?=date('Y-m-d h:s')?> Thank you for making payments with us.</small>
             <small> Rent to be paid in office only. </small>  
           </div>
       </div>
        </div> 
    <div class="no-print" align=" center">
        <button class ="print-modal1" onclick="window.print();">Print</button>
    </div>