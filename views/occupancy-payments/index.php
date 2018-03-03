<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OccupancyPaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Occupancy Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-payments-index">
<p>
       <?= Html::button('<i class="glyphicon glyphicon-ok">  Recieve Payment</i>', [
                            'type'=>'button',
                            'title'=>'Receiving Payment', 
                            'class'=>'btn btn-danger btn-create showModalButton specmargin', 
                            'value' => yii\helpers\Url::to(['occupancy-payments/create', 'id' => $occupancy->id])])?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
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
                [
                'format'=> 'raw',
                'attribute' => 'fk_receipt_id',
                 'label' => "Action",
                'value' => function ($data) {
                
                    return $data->matchBills();
                    
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
