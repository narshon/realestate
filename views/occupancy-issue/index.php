<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use app\models\OccupancyIssue;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Occupancy Issues';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-issue-index">

    <p>
         <?php 
					$dh = new DataHelper();
					  $url=Url::to(['occupancy-issue/create']);
                       echo $dh->getModalButton(new OccupancyIssue, 'occupancy-issue/create', 'OccupancyIssue', 'btn btn-danger btn-create',"New",$url,"OccupancyIssue");
                    ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-occupancy-issue',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_occupancy_id',
            'fk_related_term',
            'issue_type',
            'title',
            // 'desc:ntext',
            // '_status',
            // 'status_remarks:ntext',
            // 'date_created',
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "occupancy-issue/view", "Issues", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "occupancy-issue/update", "Issues", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
