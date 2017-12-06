<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OccupancyRentSearch;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyRent */

?>
<a href="#" class="pull-right"  onclick="print($('#occupancy-rent-receipt'));">Print</a>
<div id="occupancy-rent-receipt" class="occupancy-rent-receipt">
    
    <h3 style="text-align: center"><strong><?= Html::encode(Yii::$app->user->identity->fkManagement->management_name) ?></strong></h3>
    <h3 style="text-align: center; width:100%"> Tenant Receipt </h3>
<?php
$pay_account = $model->getPayAccount();
$occupancy_id = $model->fk_occupancy_id;
$house_no = $model->fkOccupancy->fkProperty->id;
$unit_name = $model->fkOccupancy->fkSublet->sublet_name;
?>
    <span>
       Account: <?= $pay_account ?> &nbsp;&nbsp;&nbsp; Occupancy ID: <?= $occupancy_id ?> &nbsp;&nbsp;&nbsp; Hse No: <?= $house_no ?> &nbsp;&nbsp;&nbsp; Unit: <?= $unit_name ?>
    </span>
    <?php
      $searchModel = new OccupancyRentSearch();
      $query = app\models\OccupancyRent::find()->where(['id'=>$model->id]);
      $dataProvider = new ActiveDataProvider(['query' => $query]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date_paid',
            [
                'attribute'=>'fk_source',
                'header' =>"Item",
                'value'=>function($data){
                    return isset($data->fkSource)?$data->fkSource->source_name:'';
                }
            ],
            [
                'attribute'=>'month',
                'header' =>"Period",
                'value'=>function($data){
                    return $data->month."/".$data->year;
                }
            ],
            [
                'attribute'=>'amount',
                'header' =>"Amount Due",
                'value'=>function($data){
                    return $data->amount;
                }
            ],
            [
                'attribute'=>'amount_paid',
                'header' =>"Paid",
                'value'=>function($data){
                    return $data->amount_paid;
                }
            ],
          ],
       ]); ?>
    <small>Thank you for making payments with us.</small>
</div>
<script type="text/javascript">
function print(selector) {
    var $print = $(selector)
        .clone()
        .addClass('print')
        .prependTo('body');

    //window.print() stops JS execution
    window.print();

    //Remove div once printed
    $print.remove();
}
</script>