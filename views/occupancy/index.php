<?php



/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Occupancies';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
    
       <div class="col-md-2 pull-right">
        <?= '<label class="control-label">Select Occupancy</label>'?>
        <?= kartik\widgets\Select2::widget([
            'name' => 'occupancy',
            'id' => 'occupancy-id',
            'data' => \app\models\Occupancy::getTenantOccupancies($tenant->id),
            'options' => [
                'placeholder' => 'Select Occupancy...',
                'multiple' => false
            ]
        ]);?>
            </div> 
      <div  id="occupancy-div" class="panel-body occupancy-index">
          <?php
          //get default occupancy and render view.
          $occupancy_id = \app\models\Occupancy::getDefaultOccupancy($tenant->id);
          echo  $this->render('occupancydetails', [
                'occupancy_id'=> $occupancy_id
            ]);
          ?>
            <?php // Pjax::begin(['id'=>'pjax-occupancy',]); ?> 
            <?php /* echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
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
                        'value' => function($data) {
                            return Html::button('<i class="glyphicon glyphicon-plus">  Add Bill</i>', [
                                            'type'=>'button',
                                            'title'=>'Add Bill', 
                                            'class'=>'btn btn-default showModalButton', 
                                            'value' => yii\helpers\Url::to(['occupancy-rent/create','occupancy_id'=>$data->id])]
                                    );
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
                 /*   [
                        'header' => "Match Bills",
                        'format' => 'raw',
                        'value' => function ($data) {
                             return Html::button('<i class="glyphicon glyphicon-ban-circle">  Match</i>', [
                            'type'=>'button', 
                            'title'=>'Map Payments To Bills', 
                            'class'=>'btn bg-purple btn-flat showModalButton specmargin', 
                            'value' => yii\helpers\Url::to(['occupancy-payments/map-payments', 'id'=>$data->id])]);
                        }
                    ],  *
                    
                    

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
            ]); */ ?>
             <?php // Pjax::end(); ?>

        </div>

</div>
    