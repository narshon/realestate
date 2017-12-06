<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\PropertyArea;
use yii\data\ActiveDataProvider;
use app\models\PropertyFeature;
use app\models\PropertySublet;
use app\models\PropertyTerm;
use app\models\Property;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\PropertyAreaSearch;
use app\models\PropertyFeatureSearch;
use app\models\PropertySubletSearch;
use app\models\PropertyTermSearch;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Properties';
?>

<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2>Properties</h2>
        
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><?= $this->title; ?></a></li>
            <li><a data-toggle="tab" href="#area">Property Area </a></li>
            <li><a data-toggle="tab" href="#sublets">Sublets</a></li>
            <li><a data-toggle="tab" href="#features">Features</a></li>
            <li><a data-toggle="tab" href="#terms">Terms</a></li>
        </ul>
        <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
        <div class="property-index">
            
            <p> <br/>
                <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new Property, "property/create", 'Property', 'btn btn-danger btn-create', 'New');
                ?>
            </p>
            <?php  Pjax::begin(['id'=>'pjax-property', 'timeout' => 5000]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
               // 'filterUrl'  => yii\helpers\Url::to(["property/index"]),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'property_name',
                    'property_desc:ntext',
                    'property_location:ntext',
                    [
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'attribute' => 'property_type',
                        'filter' => app\models\Lookup::getLookupValues('Property Type'),
                        'value' => function ($data) {
                            $category_id = \app\models\LookupCategory::getLookupCategoryID('Property Type');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->property_type);
                        },
                     ],
                     [
                        'attribute' => 'management',
                        'value' => 'management.profile_desc'
                     ],
                    [
                        'attribute' => 'owner',
                        'value' => 'owner.profile_desc'
                    ],
                    [
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'attribute' => '_status',
                        'filter' => app\models\Lookup::getLookupValues('Status'),
                        'value' => function ($data) {
                            $category_id = \app\models\LookupCategory::getLookupCategoryID('Status');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->_status);
                        },
                     ],
                    // 'property_video_url:ntext',
                    // 'created_by',
                    // 'date_created',
                    // 'modified_by',
                    // 'date_modified',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "property/view", "Property", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "property/update", "Property", 'glyphicon glyphicon-edit','');
                                    },
                            ], 

                    ],
                ],
            ]); ?>
            <?php  Pjax::end(); ?>
        </div>
         
      </div>

      <div id="area" class="tab-pane fade">
        <?php
              $searchModel = new PropertyAreaSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
             
            echo Yii::$app->controller->renderPartial("../property-area/index", [
            'dataProvider' => $dataProvider,  'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="sublets" class="tab-pane fade">
        <?php
            $searchModel = new PropertySubletSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
             
            echo Yii::$app->controller->renderPartial("../property-sublet/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="features" class="tab-pane fade">
        <?php
            $searchModel = new PropertyFeatureSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
             
            echo Yii::$app->controller->renderPartial("../property-feature/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="terms" class="tab-pane fade">
        <?php
            $searchModel = new PropertyTermSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
             
            echo Yii::$app->controller->renderPartial("../property-term/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

    </div>
        
    </div>
</div>

