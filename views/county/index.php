<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\County;
use app\models\Subcounty;
use app\models\Ward;
use app\models\Location;
use app\models\SubLocation;
use app\utilities\DataHelper;
use app\models\Estate;
use yii\widgets\Pjax;
use app\models\SubcountySearch;
use app\models\WardSearch;
use app\models\LocationSearch;
use app\models\SubLocationSearch;
use app\models\EstateSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Locations';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Counties</a></li>
            <li><a data-toggle="tab" href="#subcounty">Subcounties </a></li>
            <li><a data-toggle="tab" href="#wards">Wards</a></li>
            <li><a data-toggle="tab" href="#location">Locations</a></li>
            <li><a data-toggle="tab" href="#sublocation">Sub-locations</a></li>
            <li><a data-toggle="tab" href="#estate">Estates</a></li>
        </ul>
        <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
        <div class="county-index">
            <p>
                <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new County, 'county/create', 'County', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-county',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'county_name',
                    'county_desc:ntext',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "county/view", "County", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "county/update", "County", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
      </div>

      <div id="subcounty" class="tab-pane fade">
        <?php
             $searchModel = new SubcountySearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../subcounty/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="wards" class="tab-pane fade">
        <?php
             $searchModel = new WardSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../ward/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="location" class="tab-pane fade">
        <?php
             $searchModel = new LocationSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../location/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="sublocation" class="tab-pane fade">
        <?php
             $searchModel = new SubLocationSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../sub-location/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>
            
       <div id="estate" class="tab-pane fade">
        <?php 
             $searchModel = new EstateSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../estate/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

    </div>
        
    </div>
</div>
    