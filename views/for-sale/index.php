<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ForSale;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\AdvertFeatureSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advertisements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><?= $this->title; ?></a></li>
            <li><a data-toggle="tab" href="#advertfeature">Advertisement Features </a></li>
        </ul>
        <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
        <div class="tenant-index">
            <p>
                 
                  <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new ForSale, 'for-sale/create', 'Adverisements', 'btn btn-danger btn-create');
                ?>
              </p>
              <?php Pjax::begin(['id'=>'pjax-for-sale',]); ?> 
              <?= GridView::widget([
                  'dataProvider' => $dataProvider,
                  'filterModel' => $searchModel,
                  'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],

                      'id',
                      'advert_name',
                      'advert_desc:ntext',
                      [
                        'attribute' => 'advertOwner',
                        'value' => 'advertOwner.fkUser.username'
                     ],
                      'start_date',
                      // 'end_date',
                      // '_status',
                      // 'advert_fee',
                      // 'image1:ntext',
                      // 'image2:ntext',
                      // 'image3:ntext',
                      // 'image4:ntext',
                      // 'image5:ntext',
                      // 'contact_details:ntext',
                      // 'date_created',
                      // 'created_by',
                      // 'date_modified',
                      // 'modified_by',

                      ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "for-sale/view", "Adverisements", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "for-sale/update", "Adverisements", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                                            
                  ],
              ]); ?>
                <?php Pjax::end(); ?>
        </div>
      </div>

      <div id="advertfeature" class="tab-pane fade">
        <?php
             
             $searchModel = new AdvertFeatureSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../advert-feature/index", [
            'dataProvider' => $dataProvider,   'searchModel' => $searchModel,
        ]);  ?>
      </div>


    </div>
        
    </div>
</div>