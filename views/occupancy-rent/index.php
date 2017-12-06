<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use app\models\OccupancyRent;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Occupancy Rents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-rent-index">

    <p>
       <?php 
                      $dh = new DataHelper();
                      $url = Url::to(['occupancy-rent/receivepay','occupancy_id'=>$occupancy->id]);
                      echo $dh->getModalButton(new \app\models\OccupancyRent, 'occupancy-rent/receivepay', 'Receive Payment', 'btn btn-danger btn-create','Receive Payment',$url);
        ?>
    </p>
            <?php // Pjax::begin(['id'=>'pjax-occupancy-rent',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'fk_occupancy_id',
            [
                'attribute'=>'fk_source',
                'value'=>function($data){
                    return isset($data->fkSource)?$data->fkSource->source_name:'';
                }
            ],
            'month',
            'year',
            'amount',
            'amount_paid',
           /* [
                'attribute'=>'pay_rent_due',
                'value'=>function($data){
                    return $data->getPayDue();
                }
            ],  */
            [
                'attribute'=>'balance_due',
                'value'=>function($data){
                    return $data->getBalanceDue();
                }
            ],
            'date_created',
            [
                'attribute'=>'_status',
                'format'=>'raw',
                'value'=>function($data){
                    return $data->getStatus();
                }
            ],
             
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

           /* ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "occupancy-rent/view", "Rent", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "occupancy-rent/update", "Rent", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ], */
                ],
            ]); ?>
             <?php // Pjax::end(); ?>
</div>
