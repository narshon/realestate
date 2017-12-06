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
use app\models\OccupancySearch;
use yii\helpers\Url;
use app\models\PropertyTermSearch;
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
           
        </ul>
        <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
        <div class="occupancy-index">
            <?php Pjax::begin(['id'=>'pjax-occupancy',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'fk_property_id',
                        'format' => 'raw',
                        //'filter'=> app\models\Property::getLookupValues('Property Type'),
                        'value' => function ($data) {
                              return $data->fkProperty->getPropertyNameLink();
                        },
                    ],
                    [
                        'attribute' => 'fk_sublet_id',
                        'format' => 'raw',
                        'value' => function ($data) {
                              return $data->fkSublet->sublet_name;
                        },
                    ],
                   // 'fk_user_id',
                    'start_date',
                    'end_date',
                     [
                        'attribute' => '_status',
                        'format' => 'raw',
                        'value' => function ($data) {
                              $category_id = \app\models\LookupCategory::getLookupCategoryID('Status');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->_status);
                        },
                    ],
                    [
                        'attribute' => 'rent',
                        'header' => "Rent Bills",
                        'format' => 'raw',
                        'value' => function ($data) {
                              $dh = new DataHelper();
                              $url = Url::to(['occupancy-rent/create','occupancy_id'=>$data->id]);
                              return $dh->getModalButton($data, "occupancy-rent/create", "Occupancy", 'btn btn-default','Add Bill',$url);
                        },
                    ],
                    [
                        'attribute' => 'term',
                        'header' => "Terms",
                        'format' => 'raw',
                        'value' => function ($data) {
                              $dh = new DataHelper();
                              $url = Url::to(['occupancy-term/create','occupancy_id'=>$data->id]);
                              return $dh->getModalButton($data, "occupancy-term/create", "Occupancy", 'btn btn-default','Add Term',$url);
                        },
                    ],
                    
                    

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['occupancy/view','id'=>$model->id]);
                                             // $popup = $dh->getModalButton($model, "occupancy/view", "Occupancy", 'glyphicon glyphicon-eye-open','',$url);
                                              $a = Html::a("",$url,['class'=>'glyphicon glyphicon-eye-open','onclick'=>"ajaxUniversalGetRequest('$url','rent','', 1); return false"]);
                                              return $a;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['occupancy/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "occupancy/update", "Occupancy", 'glyphicon glyphicon-edit','',$url);
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
      </div>

      <div id="rent" class="">
        <?php
           /*  
             $searchModel = new OccupancyRentSearch();
             $dataProvider =  $searchModel->search(Yii::$app->request->get());                               //new ActiveDataProvider(['query' => OccupancyRent::getSearchQuery($searchModel,$tenant->id)]);
            echo Yii::$app->controller->renderPartial("../occupancy-rent/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 
        ]);  */  ?>
      </div>

      <div id="issue" class="">
        <?php
          /*   
             $searchModel = new OccupancyIssueSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-issue/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  
           * 
           */ ?>
      </div>

      <div id="terms" class="">
        <?php
            /* 
             $searchModel = new OccupancyTermSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-term/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  */  ?>
      </div>
      <div id="propterms" class="">
        <?php
         /*    
             $searchModel = new PropertyTermSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../property-term/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'property'=>''
        ]); */ ?>
      </div>

    </div>
        
    </div>
</div>
    