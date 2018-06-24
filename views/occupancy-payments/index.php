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
       
    </p>
<?php Pjax::begin(['id'=>'pjax-occupancy-payments']); ?>    
  <?= GridView::widget([
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
                'attribute' => 'mode',
                'value' => function($data) {
                $list = \app\models\Lookup::getLookupValues('Payment Mode');
                    return array_key_exists($data->mode, $list) ? $list[$data->mode] : $data->mode;
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
          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
