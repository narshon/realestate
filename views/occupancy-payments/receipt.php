<?php
use yii\helpers\Html;
use kartik\grid\GridView;
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
		
            <h3 style="text-align: center; width:100%"> Property Management, </h3>
			<h4 style="text-align: center; width:100%"> City Grocers House, Opposite Blue Room cafe,Above KCB </h4>
			<h4 style="text-align: center; width:100%"> Tel:2224316,0722756723-Mombasa-Kenya. </h4>
       </div>
       <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <label>NO.</label>
           </div>
		   
           <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		       <div class="row">
			      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <label>House No:</label>
                   </div>
                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <label>DATE:</label>
                  </div>
		      </div>
       
	        </div>
	   </div>
	   <div class="row">RECEIVED from:</div>
	   <div class="row">The sum of shillings:</div>
	   <div class="row">
	       <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">Being payment of:</div>
	       <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">House Rent:</div>
		</div>
		<div class="row">Cash/cheque:</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">REMARKS:</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">signature:</div>
		</div>
		
       <div class="row">
           <small>Printed on: <?=date('Y-m-d h:s')?> Thank you for making payments with us.</small>  
       </div>
    </div> 
</div>
<div class="no-print">
    <button class ="print-modal">Print</button>
</div>
