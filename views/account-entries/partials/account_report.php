<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;
use app\models\Term;
use kartik\grid\GridView;
use \app\models\AccountChart;
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
<div id="ac-id">
<div  class="account-entries-index panel panel-danger admin-content">
<div class="panel-heading">
        <h1>Financial Records</h1>
   </div>

	<div class="panel-body">
	<div class="leftbar__ col-md-2">
            <ul class="nav nav-tabs" id="myTab__" role="tablist">
                <?php
                echo Collapse::widget([
                    'items' => \app\models\AccountEntries::getNavigationItems()
                ]); ?>
	     </ul> 
	</div>
<div id="statement_box" class="rightbar col-md-10">
        <div class="row">
            <div class="col-md-2 pull-right">
                
                <?php
                $url = \yii\helpers\Url::to(['account-report']);
               echo Html::a("Load Report", "#", ['class' => "btn btn-danger btn-account-report",  'onclick'=>"ajaxUniversalGetRequest('$url','account-report-div',getAccountReportParams(), 1); return false;"]);
                
                ?>
            </div>
            <div class="col-md-3 pull-right">
                <?= '<label class="control-label">To</label>'?>
                <?= kartik\widgets\DatePicker::widget([
                    'name' => 'to',
                    'id' => 'to',
                   // 'data' => app\utilities\DataHelper::getMonthOptions(),
                    'options' => [
                        'placeholder' => 'Please Select',
                        'format' => 'd-m-Y',
                        'multiple' => false
                    ]
                ]);?>
            </div>
            <div class="col-md-3 pull-right">
                <?= '<label class="control-label">From</label>'?>
                <?= kartik\widgets\DatePicker::widget([
                    'name' => 'from',
                    'id' => 'from',
                    'options' => [
                        'placeholder' => 'Please Select',
                        'format' => 'd-m-Y',
                        'multiple' => false
                    ]
                ]);?>
            </div>
            <div class="col-md-2 pull-right">
                    <?= '<label class="control-label">Accounts</label>'?>
                    <?=kartik\widgets\Select2::widget([
                        'name' => 'account_no',
                        'id' => 'account-no',
                        'data' => AccountChart::getAccountsByType("Liabilities")+AccountChart::getAccountsByType("Expenses")+AccountChart::getAccountsByType("Equity")+AccountChart::getAccountsByType("Revenue"),
                        'options' => [
                            'placeholder' => 'Select Account...',
                            'multiple' => false
                        ]
                    ]);?>
            </div>
        </div>
        <div id="account-report-div">
            <h3> <?php echo $account->name; ?> Statement</h3>
        </div>
        
<?php 
//report comes here

?>

</div>
</div>
</div>
</div>