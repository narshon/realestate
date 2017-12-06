<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\OccupancyTerm;
use app\utilities\DataHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Occupancy Terms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-term-index">

    <p>
        <?php 
                     // $dh = new DataHelper();
                     //  echo $dh->getModalButton(new \app\models\LookupCategory, 'occupancy-term/create', 'Terms', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-occupancy-term',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
              'header'=>'Term',
               'filter'=>true,
                'value'=>function($data){
                     return $data->fkPropertyTerm->term_title;
                }
            ],
            'date_signed',
            'value',
            '_status',
            // 'date_modified',
            // 'created_by',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "occupancy-term/view", "Terms", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "occupancy-term/update", "Terms", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
