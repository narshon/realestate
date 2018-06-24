<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="confirm-pay">
<div>
    <span style="float:left; width: 60%"><h3>LANDLORD PAYMENT ADVICE</h3></span> 
    <span style="float:right; width: 40%"><h3> <?php echo date("d-m-Y") ?> </h3></span> 
</div><br/><div class="clear"></div>
<div>
    <span style="float:left; width: 60%">Month: ### </span> 
    <span style="float:right; width: 40%">Our Ref: ### </span> 
</div><br/><div class="clear"></div>
<div>
    <span >Account: 025</span> 
</div><br/><div class="clear"></div>
<div>
    <?php
      $names =  \app\models\Users::find()->where(["id"=>$owner_id])->one();
      if($names){
          $names = $names->getNames();
      }
      else{
          $names = "";
      }
    ?>
    <span style="float:left; width: 60%">Mr/Mrs: <?php echo $names ?></span> 
    <span style="float:right; width: 40%">
        <?= '<label class="control-label">Select Funds Account</label>'?>
        <?=kartik\widgets\Select2::widget([
            'name' => 'fund_account',
            'id' => 'fund-account',
            'data' => \app\models\AccountChart::getFundAccounts(),
            'options' => [
                'placeholder' => 'Select Funds',
                'multiple' => false
            ]
        ]);?>
    </span> 
</div><br/><div class="clear"></div>
<?php
/*
echo "Uncleared Bills = ".print_r($bills,true)."<br/>";
echo "Cleared Bills = ".$cleared_bills."<br/>";
echo "Advance_ids = ".$model->payments_advance_ids."<br/>";
echo "Owner ID = ".$owner_id."<br/>";
*/
?>
<table id="t01">
    <tr>
        <td colspan="5" text-align="center"> <h3> Cleared Bills </h3> </td>
    </tr>  
  <tr>
    <th>Tenant's Name</th>
    <th>Period</th> 
    <th>Paid By Tenant</th>
    <th>Paid By Agent</th>
   <!-- <th>Commission</th>
    <th>Net Pay</th>  -->
  </tr>
  <?php
  //start with cleared bills.
  $cleared_array = explode(",", $cleared_bills);
  if(is_array($cleared_array)){
   foreach($cleared_array as $bill){
       $bill_array = explode('_',$bill);
       $bill_id = $bill_array[0];
       $disbursement = \app\models\Disbursements::find()->where(['id'=>$bill_id])->one();
       if($disbursement){
          echo <<<EOF
            <tr>
                <td>{$disbursement->getTenantName()}</td>
                <td>$disbursement->month/$disbursement->year</td>
                <td>{$disbursement->getPaidByTenantAmount()}</td>
                <td>{$disbursement->getPaidByAgentAmount()}</td>
              <!--  <td>{$disbursement->getCommissionCharged()}</td>
                <td>{$disbursement->getTotalPaid()}</td>  -->
          </tr>
           
EOF;
          
       }
   } 
  }
  ?>
  <?php
  $uncleared_array = explode(",", $bills);
  if(is_array($uncleared_array)){
   foreach($uncleared_array as $bill){
       $bill_array = explode('_',$bill);
       $bill_id = $bill_array[0];
       $disbursement = \app\models\Disbursements::find()->where(['id'=>$bill_id])->one();
       if($disbursement){
          echo <<<EOF
            <tr>
                <td>{$disbursement->getTenantName()}</td>
                <td>$disbursement->month/$disbursement->year</td>
                <td>-</td>
                <td>-</td>
          </tr>
           
EOF;
          
       }
   } 
  }
  ?>
</table>
<!--
<table id="t03">
    <tr>
        <td colspan="3" text-align="center"> <h3> Advances/Loans </h3> </td>
    </tr>  
  <tr>
    <th>Imprest Type</th>
    <th>Date</th> 
    <th>Amount</th>
  </tr>
  <?php
  //start with cleared bills.
  $advances_array = explode(",", $model->payments_advance_ids);
  if(is_array($advances_array)){
   foreach($advances_array as $advance){
       
       $imprest = \app\models\LandlordImprest::find()->where(['id'=>$advance])->one();
       if($imprest){
          echo <<<EOF
            <tr>
                <td>$imprest->imprest_type</td>
                <td>$imprest->entry_date</td>
                <td>$imprest->amount</td>
                
          </tr>
           
EOF;
          
       }
   } 
  }
  ?>
</table>  -->
<h3> TOTAL AMOUNT COLLECTED = <?php echo $model->getTotalBills($cleared_bills); // $model->payments_advance ?> </h3><br/>
<strong> LESS: COMMISSION = <?php echo $model->getTotalCommission($cleared_bills); ?> <br/>
     LESS: Advances/Loans = <?php echo $model->payments_advance; ?> </strong><br/>
     <h3>
         NET PAYMENT = <?php echo ($model->getTotalBills($cleared_bills) - ($model->getTotalCommission($cleared_bills) + $model->payments_advance)); ?>
     </h3>
 
<?php $url =  Url::to(['disbursements/make-payments', 'owner_id'=>$owner_id,'cleared_bills'=>$cleared_bills,'advance_ids'=>$model->payments_advance_ids, 'total_advance'=>$model->payments_advance]);  ?>
<?= Html::submitButton("Confirm Payment", ['class' =>'btn bg-purple btn-flat btn-success specmargin pull-right','onclick'=>"ajaxUniversalGetRequest('$url','confirm-pay',$('#fund-account').val(), 1); return false;"]); //  ?>


</div>