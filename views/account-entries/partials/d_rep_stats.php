<?php
use app\models\AccountEntries;
?>
<p>
	<?php  echo AccountEntries::actionButtons();  ?>
    </p>
<div id="sum_box" class="row mbl">
    <div class=" col-md-2">
        <div class="panel income db mbm">
            <div class="panel-body">
                <p class="icon">
                    <i class="icon fa fa-users"></i>
                </p>
                <h4 class="value">
                    <span><?= \app\models\AccountEntries::getDailyReportItem(1101, $date = date('Y-m-d'))?></span><small> /=</small></h4>
                <p class="description">
                    Cash</p>

            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="panel profit db mbm">
            <div class="panel-body">
                <p class="icon">
                    <i class="icon fa fa-users"></i>
                </p>
                <h4 class="value">
                    <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0"><?= \app\models\AccountEntries::getDailyReportItem(1122, $date = date('Y-m-d'))?></span><small> /=</small></h4>
                <p class="description">
                    Cash Safe</p>

            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="panel task db mbm">
            <div class="panel-body">
                <p class="icon">
                    <i class="icon fa fa-users"></i>
                </p>
                <h4 class="value">
                    <span><?= \app\models\AccountEntries::getDailyReportItem(1102, $date = date('Y-m-d'))?></span><small> /=</small></h4>
                <p class="description">
                    Bank</p>

            </div>
        </div>
    </div>
    
    

<div class="col-md-2">
        <?= '<label class="control-label">Summary</label>'?>
        <?=kartik\widgets\Select2::widget([
            'name' => 'summary_item',
            'id' => 'daily-summary',
            'data' => \app\models\AccountChart::getAllFundAccounts(),
            'options' => [
                'placeholder' => 'Select Summary Item..',
                'multiple' => false
            ]
        ]);?>
    </div>
</div>