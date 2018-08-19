<?php
use yii\helpers\Html;

?>
<h3>Tenant Statement</h3>
 <div class="col-md-2 pull-left">
    <?= '<label class="control-label">Select Occupancy</label>'?>
    <?= kartik\widgets\Select2::widget([
        'name' => 'occupancy',
        'id' => 'occupancy-statement-id',
        'value' => $occupancy_id,
        'data' => \app\models\Occupancy::getTenantOccupancies($tenant->id),
        'options' => [
            'placeholder' => 'Select Occupancy...',
            'multiple' => false
        ]
    ]);?>
  </div>
<div class="col-md-3 pull-left">
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
<div class="col-md-3 pull-left">
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
<div class="col-md-2 pull-left">

    <?php
    $url = \yii\helpers\Url::to(['tenant-report']);
   echo Html::a("Load Report", "#", ['class' => "btn btn-danger btn-monthly-report",  'onclick'=>"ajaxUniversalGetRequest('$url','tenant-report-div',getTenantReportParams(), 1); return false;"]);

    ?>
</div>

<div class="tenant-report" id="tenant-report-div">
    
</div>

