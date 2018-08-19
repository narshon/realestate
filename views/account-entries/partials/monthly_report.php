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
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"> <h3> <?php echo $account->name; ?> Report</h3></div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <table id="t01">   
              <tr>
                <th>DATE</th>
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
              if($query){
                  foreach($query as $data){
                      ?>
              <tr>
                <td><?php echo $data->entry_date ?></td> 
                <td><strong><?php echo app\models\AccountEntries::getTotalCRent($data->fk_account_chart, $data->entry_date, $data->entry_date); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalBalance($data->fk_account_chart, $data->entry_date, $data->entry_date); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalVLockFee($data->fk_account_chart, $data->entry_date, $data->entry_date); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalPENFee($data->fk_account_chart, $data->entry_date, $data->entry_date); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalDEPFee($data->fk_account_chart, $data->entry_date, $data->entry_date); ?></strong></td>               
                <td><strong><?php echo app\models\AccountEntries::getTotalAgencyFee($data->fk_account_chart, $data->entry_date, $data->entry_date); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalOtherFee($data->fk_account_chart, $data->entry_date, $data->entry_date); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalAmountReceived($data->fk_account_chart, $data->entry_date, $data->entry_date); ?></strong></td>
              </tr>
              
              <?php
                      
                  }
              }
              ?>
              <tr>
                  <td><strong>Total</strong></td> 
                <td><strong><?php echo app\models\AccountEntries::getTotalCRent($account->id, $date1, $date2); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalBalance($account->id, $date1, $date2); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalVLockFee($account->id, $date1, $date2); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalPENFee($account->id, $date1, $date2); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalDEPFee($account->id, $date1, $date2); ?></strong></td>               
                <td><strong><?php echo app\models\AccountEntries::getTotalAgencyFee($account->id, $date1, $date2); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalOtherFee($account->id, $date1, $date2); ?></strong></td>
                <td><strong><?php echo app\models\AccountEntries::getTotalAmountReceived($account->id, $date1, $date2); ?></strong></td>
              </tr>
           </table>
            
        </div>
    </div>
</div>
 