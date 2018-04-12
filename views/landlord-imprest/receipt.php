<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
use app\models\LandlordImprest;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="confirm-pay">
    <div class="no-print" align=" center">
        <button class ="print-modal1" onclick="window.print();">Print</button>
    </div>
<div>
    <span style="float:left; width: 60%"><h3>LANDLORD PAYMENT ADVICE</h3></span> 
    <span style="float:right; width: 40%"><h3> <?php echo date("d-m-Y") ?> </h3></span> 
</div><br/><div class="clear"></div>
<div>
    <span style="float:left; width: 60%">Month: <?php echo date("M",strtotime($model->entry_date)); ?> </span> 
    <span style="float:right; width: 40%">Our Ref: <?php echo $model->id; ?>  </span> 
</div><br/><div class="clear"></div>
<div>
    <span >Account: <?php echo $model->fk_landlord; ?></span> 
</div><br/><div class="clear"></div>
<div>
    <?php
      $names =  \app\models\Users::find()->where(["id"=>$model->fk_landlord])->one();
      if($names){
          $names = $names->getNames();
      }
      else{
          $names = "";
      }
    ?>
    <span>Mr/Mrs: <?php echo $names ?></span> 
</div><br/><div class="clear"></div>
<?php if($model->imprest_type == "Disbursement") { ?>
<table id="t01">
    <tr>
        <td colspan="5" text-align="center"> <h3> Cleared Bills </h3> </td>
    </tr>  
  <tr>
    <th>Tenant's Name</th>
    <th>Period</th> 
    <th>Amount</th> 
    <th>Paid By Tenant</th>
    <th>Paid By Agent</th>
    <th>Commission</th>
    <th>Net Pay</th>
  </tr>
  <?php
  //start with cleared bills.
  $disbursements = \app\models\Disbursements::find()->where(['batch_id'=>$model->id])->all();
  $total_disb = 0;
  if($disbursements){
   foreach($disbursements as $disbursement){
       
          echo <<<EOF
            <tr>
                <td>{$disbursement->getTenantName()}</td>
                <td>$disbursement->month/$disbursement->year</td>
                <td>{$disbursement->fkOccupancyRent->amount}</td>
                <td>{$disbursement->getPaidByTenantAmount()}</td>
                <td>{$disbursement->getPaidByAgentAmount()}</td>
                <td>{$disbursement->getCommissionCharged()}</td>
                <td>{$disbursement->getTotalPaid()}</td>
          </tr>
           
EOF;
      $total_disb += $disbursement->getTotalPaid();    
   } 
  }
  ?>
</table>

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
  $imprests = LandlordImprest::find()->where(['settlement_id'=>$model->id])->all();
  $total_advance = 0;
  if($imprests){
   foreach($imprests as $imprest){
       
          echo <<<EOF
            <tr>
                <td>$imprest->imprest_type</td>
                <td>$imprest->entry_date</td>
                <td>$imprest->amount</td>
                
          </tr>
           
EOF;
          
    $total_advance +=  $imprest->amount; 
   } 
  }
  ?>
</table>
<h3> TOTAL AMOUNT PAID = <?php echo $total_disb - $total_advance; ?> </h3>
<?php } else{ ?>
<p> 
    Received, Kes <?php echo $model->amount; ?> <i>( <?php 
    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
     echo $f->format($model->amount);
   ?>  )</i>
</p>
<p>
    Being payment of <?php echo $model->narration; ?> 
</p>
<?php }  ?>
</div>