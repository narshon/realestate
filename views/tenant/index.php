<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\TenantFavourite;
use app\models\TenantPreference;
use app\utilities\DataHelper;
use app\models\Tenant;
use yii\widgets\Pjax;
use app\models\TenantFavouriteSearch;
use app\models\TenantPreferenceSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenants';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><?= $this->title; ?></a></li>
            <li><a data-toggle="tab" href="#preference">Tenant Preferences </a></li>
            <li><a data-toggle="tab" href="#favourite">Tenant Favourites </a></li>
        </ul>
        <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
        <div class="tenant-index">

            <p>
                <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'tenant/create', 'Tenants', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-tenant',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'fk_user_id',
                    'tenant_desc:ntext',
                    'date_created',
                    'created_by',
                    // 'date_modified',
                    // 'modified_by',
                    // '_status',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "tenant/view", "Tenants", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "tenant/update", "Tenants", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
      </div>

      <div id="preference" class="tab-pane fade">
        <?php
             
             $searchModel = new TenantPreferenceSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../tenant-preference/index", [
            'dataProvider' => $dataProvider,   'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="favourite" class="tab-pane fade">
        <?php
             
             $searchModel = new TenantFavouriteSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../tenant-favourite/index", [
            'dataProvider' => $dataProvider,   'searchModel' => $searchModel,
        ]);  ?>
      </div>

    </div>
        
    </div>
</div>
    