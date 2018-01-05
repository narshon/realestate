<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Lookup;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\LookupSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lookup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><?= $this->title; ?> Categories</a></li>
            <li><a data-toggle="tab" href="#lookups">Lookups </a></li>
        </ul>
        <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
        <div class="lookup-category-index">

            <p>
                <?php 
                $dh = new DataHelper();
			$url=Url::to(['lookup-category/create']);
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'lookup-category/create', 'Lookups', 'btn btn-danger btn-create',"New",$url,"Lookup");
                      ?>
            </p>
                       
            <?php Pjax::begin(['id'=>'pjax-lookup-category',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'category_name',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "lookup-category/view", "Lookups", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "lookup-category/update", "Lookups", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
        </div>
      </div>

      <div id="lookups" class="tab-pane fade">
        <?php
             $searchModel = new LookupSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
             
            echo Yii::$app->controller->renderPartial("../lookup/index", [
            'dataProvider' => $dataProvider,  'searchModel' => $searchModel,
        ]);  ?>
      </div>

    </div>
        
    </div>
</div>
    