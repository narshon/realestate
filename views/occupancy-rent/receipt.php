<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OccupancyRentSearch;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
?>
<div class="print-area">
   <div class="col-md-12">
       <div class="col-md-12">
            <h3 style="text-align: center">
                <strong><?= Html::encode(Yii::$app->user->identity->fkManagement->management_name) ?></strong>
            </h3>
            <h3 style="text-align: center; width:100%"> Tenant Receipt </h3>
       </div>
       <div class="row">
           <div class="col-md-3">
               <label>Account:</label>
           </div>
           <div class="col-md-3">
               <label>House No:</label>
           </div>
           <div class="col-md-3">
               <label>Unit:</label>
           </div>
           <div class="col-md-3">
               <label>Occupant</label>
           </div>
       </div>
       <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
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
                ]
            ]); ?>
       </div>
       <div class="row">
           <small>Printed on: <?=date('Y-m-d h:s')?> Thank you for making payments with us.</small>  
       </div>
    </div> 
</div>
<div class="no-print">
    <button class ="print-modal">Print</button>
</div>
