<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;
use app\models\Term;
use kartik\grid\GridView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->registerCss("
            .container{
                width:98% !important;
            }
            .leftbar{
               background: #B5121B;
               color:#ffffff !important;
               padding-top:10px;
            }
            .leftbar a{
                color:#ffffff !important;
            }
            .leftbar a:hover, a:active{
                color:#000000 !important;;
                /* background-color: #000000 !important; */
            }
            
            .rightbar{
                
            }
        "); 
?>

<div id="print_area">
    <div class="row mbl">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"> <h3> <?php echo $account->name; ?> Report</h3></div>
    </div>
    </div>
    <?php if($report_type=="cumulative"): ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <br/> <strong> OPENING BALANCE: <span><?= \app\models\AccountEntries::getCumulativeReportItem($account->code, date("Y-m-d",strtotime("-1 days")))?></span></strong></div>
    </div>
    <?php endif  ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <table id="t01">   
              <tr>
                <th>NAME</th>
                <th>HSE</th> 
                <th>C/RENT</th>
                <th>BAL</th>
                <th>Lock/Visit Fee</th>
                <th>Pen Fee</th>
                <th>Dep Fee</th>
                <th>Agency Fee</th>
                <th>Other Fees</th>
                <th>Total</th>
              </tr>
              
              <?php
               //loop through and generate report.
              if($transactions){
                  foreach($transactions as $data){
                      echo "<tr>";
                        echo "<td>";
                        echo $data->getClientName();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->getHouse();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->getCRent();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->getRentBal();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->getVLockFee();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->getPenaltyFee();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->getDepositFee();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->getAgencyFee();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->getOtherFee();
                        echo "</td>";
                        
                        echo "<td>";
                        echo $data->amount;
                        echo "</td>";
                        
                      echo "</tr>";
                      
                  }
              }
              ?>
              <tr>
                  <td> <strong>TOTALS</strong>  </td>
                <td></td> 
                <td><strong><?php echo app\models\AccountEntries::getTotalCRent($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalBalance($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalVLockFee($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalPENFee($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalDEPFee($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalAgencyFee($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalOtherFee($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalAmountReceived($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
              </tr>
           </table>
            <strong>LESS </strong> 
            <table id="t02">   
              <tr>
                <th>NAME</th>
                <th>TYPE</th> 
                <th>PARTICULARS</th>
                <th>AMOUNT</th>
              </tr>
              <?php
               $credits = app\models\AccountEntries::find()->where(['fk_account_chart'=>$account->id, 'trasaction_type'=>"credit", 'entry_date'=>date('Y-m-d')])->all();
               if($credits){
                   foreach($credits as $credit){
                      echo "<tr>";
                        echo "<td>";
                        echo $credit->getTransactedUser();
                        echo "</td>"; 
                        echo "<td>";
                        echo $credit->getTransactionSourceName();
                        echo "</td>"; 
                        echo "<td>";
                        echo $credit->getTransactionParticulars();
                        echo "</td>"; 
                        echo "<td>";
                        echo $credit->amount;
                        echo "</td>"; 
                        
                        echo "</tr>";
                   }
               }
              ?>
              <tr>
                  <td> <strong>TOTALS</strong>  </td>
                <td></td> 
                <td></td> 
                <td><strong><?php echo app\models\AccountEntries::getTotalAmountPaid($account->id, date("Y-m-d"), date("Y-m-d")); ?></strong></td>
              </tr>
            </table>
        </div>
    </div>
    <?php if($report_type=="cumulative"): ?>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <br/> <strong> CLOSING BALANCE: <span><?= \app\models\AccountEntries::getCumulativeReportItem($account->code, date("Y-m-d"))?></span></strong></div>
    </div>
    <?php else: ?>
       <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <br/> <strong> DAILY BALANCE: <span><?= \app\models\AccountEntries::getDailyReportItem($account->code, date("Y-m-d"))?></span></strong></div>
    </div>
   <?php endif ?>
</div>
 