<?php
use app\models\AccountEntries;
use yii\helpers\Url;
?>
<p class="no-print">
	<?php  echo AccountEntries::actionButtons();  ?>
    </p>
<div id="sum_box" class="no-print row mbl">    
   
   <div class="no-print col-md-2">
        <?= '<label class="control-label">Report Type</label>'?>
        <?=kartik\widgets\Select2::widget([
            'name' => 'report_type',
            'id' => 'report-type',
            'data' => ['daily'=>"Daily",'cumulative'=>"Cummulative Report"],
            'options' => [
               // 'placeholder' => 'Select Item...',
                'multiple' => false
            ]
        ]);?>
    </div>
<div class="no-print col-md-2">
        <?= '<label class="control-label">Account</label>'?>
        <?=kartik\widgets\Select2::widget([
            'name' => 'summary_item',
            'id' => 'daily-summary',
            'data' => \app\models\AccountChart::getAllFundAccounts(),
            'options' => [
                //'placeholder' => 'Select Summary Item..',
                'multiple' => false
            ]
        ]);?>
    </div>
     <div class="no-print col-md-2" align=" center">
         <?php  $css_url = trim(Url::to('@web/css/site.css', true));  ?> 
        <button class ="print-modal1" onclick="printDiv('summary-content-div','<?= $css_url ?>')">Print</button>
    </div>
</div>