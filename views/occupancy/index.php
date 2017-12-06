<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Occupancy;
use app\models\OccupancyIssue;
use app\models\OccupancyRent;
use app\models\OccupancyTerm;
use app\models\Tenant;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\TenantSearch;
use app\models\OccupancyIssueSearch;
use app\models\OccupancyRentSearch;
use app\models\OccupancyTermSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Occupancies';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><?= $this->title; ?></a></li>
            <li><a data-toggle="tab" href="#tenant">Tenant Profile </a></li>
            <li><a data-toggle="tab" href="#rent">Rent Collection</a></li>
            <li><a data-toggle="tab" href="#issue">Issues</a></li>
            <li><a data-toggle="tab" href="#terms">Occupancy Terms</a></li>
        </ul>
        <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
        <div class="occupancy-index">

            <p>
                <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\Occupancy, 'occupancy/create', 'Occupancy', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-occupancy',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'fk_property_id',
                    'fk_sublet_id',
                    'fk_tenant_id',
                    'start_date',
                    // 'end_date',
                    // 'notes:ntext',
                    // '_status',
                    // 'date_created',
                    // 'created_by',
                    // 'date_modified',
                    // 'modified_by',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "occupancy/view", "Occupancy", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "occupancy/update", "Occupancy", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
      </div>

      <div id="tenant" class="tab-pane fade">
        <?php
            /* $dataProvider = new ActiveDataProvider([
                    'query' => Tenant::find(),
             ]); */
             $searchModel = new TenantSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
             
            echo Yii::$app->controller->renderPartial("../tenant/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="rent" class="tab-pane fade">
        <?php
             
             $searchModel = new OccupancyRentSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-rent/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="issue" class="tab-pane fade">
        <?php
             
             $searchModel = new OccupancyIssueSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-issue/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="terms" class="tab-pane fade">
        <?php
             
             $searchModel = new OccupancyTermSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-term/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

    </div>
        
    </div>
</div>
    