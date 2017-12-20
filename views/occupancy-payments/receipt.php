<?php
use yii\helpers\Html;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */
/* @var $form yii\widgets\ActiveForm */

?>
<div id="print_area">
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
                        'id',
                        //'fk_occupancy_id',
                        'amount',
                        'payment_date',

                        [
                            'attribute' => 'payment_method',
                            'value' => function($data) {
                            $list = \app\models\Lookup::getLookupValues('Payment Method');
                                return array_key_exists($data->payment_method, $list) ? $list[$data->payment_method] : $data->payment_method;
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function($data) {
                            $list = \app\models\Lookup::getLookupValues('Payment Status');
                                return array_key_exists($data->status, $list) ? $list[$data->status] : $data->status;
                            }
                        ],
                        'ref_no',
                        [
                            'attribute' => 'created_by',
                            'value' => function($data) {

                                return implode(' - ', \app\models\Users::getDetail(['id','username'],$data->created_by ));
                            }
                        ],
                        'created_on',
                        // 'modified_by',
                        // 'modified_on',
                       
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
