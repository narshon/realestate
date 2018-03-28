<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Lookup;
use app\models\LookupCategory;
/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */
/* @var $form yii\widgets\ActiveForm */

?>
<div id="print_area">
   <div class="col-md-12">
       <div class="col-md-12">
            <h3 style="text-align: center">
                <strong><?= Html::encode(Yii::$app->user->identity->fkManagement->management_name) ?></strong>
            </h3>
		
            <h3 style="text-align: center; width:100%;"> Property Management, </h3>
			<h4 style="text-align: center; width:100%"> City Grocers House, Opposite Blue Room cafe,Above KCB </h4>
			<h4 style="text-align: center; width:100%"> Tel:2224316,0722756723-Mombasa-Kenya. </h4>
       </div>
       
       <div class="row" style ="margin-top: 13%;" >
           
           <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><label>Receipt NO :</label><?= $model->fkReceipt->receipt_no ?></div>
           <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><label>House: </label><?=$model->fkOccupancy->fk_property_id.' '.$model->fkOccupancy->fkProperty->property_name;?>
                <label>Sublet: <?=$model->fkOccupancy->fkSublet->sublet_name ?></label>
           </div>
                 <label>DATE: <?=$model->payment_date?></label>
           </div>

	   </div>
	   <div class="row"><label>RECEIVED from: </label><?=$model->fkOccupancy->fkUsers->getNames()?></div>
           <div class="row"><label>The sum of shillings: </label><?=$model->amount?></div>
	   <div class="row">
               <div class = "col-xs-2 col-sm-2 col-md-1 col-lg-1"></div>
           <div class="col-xs-10 col-sm-10 col-md-8 col-lg-8">
           <table id="t01">   
              <tr>
                <th>Item</th>
                <th>Period</th> 
                <th>Amount</th>
                
              </tr>
              <?php
              //start with cleared bills.
                $bills = $model->getMatchedBillItems();
                if($bills){
                    foreach($bills as $bill){
                      $term = isset($bill->fkOccupancyRent->fkTerm->term_name)?$bill->fkOccupancyRent->fkTerm->term_name:'';
                        echo <<<EOF
                        <tr>
                            <td>$term</td>
                            <td>{$bill->fkOccupancyRent->month}/{$bill->fkOccupancyRent->year}</td>
                            <td>{$bill->amount}</td>
                      </tr>

EOF;
                    }
                }
                      

                   
              ?>
            </table>
           
           
           </div>
		</div>
           <div class="row">
               <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"></div>
               <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11"><label>Payment  Method: </label><?=$model->getPaymentMethod();?></div>
           </div>
		<div class="row">
                    <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"></div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">REMARKS:</div>
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">signature:</div>
		</div>
       <div class="row">
           <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"></div>
           <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11" align=" center"><small>Printed on: <?=date('Y-m-d h:s')?> Thank you for making payments with us.</small></div>
       </div>
        </div> 
    <div class="no-print" align=" center">
        <button class ="print-modal1" onclick="window.print();">Print</button>
    </div>
