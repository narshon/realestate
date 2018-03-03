<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Locations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-location-index">


    <p>
        <?php 
                    
                      $dh = new DataHelper();
					   $url=Url::to(['sub-location/create']);
                     echo $dh->getModalButton(new \app\models\LookupCategory, 'sub-location/create', 'Sub Locations', 'btn btn-danger btn-create',"New",$url,"Sublocation");
                 ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-sub-location',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' =>'fk_location',
                'value' => 'fkLocation.location_name'
             ],
            //'fk_location',
            'sub_loc_name',
            'sub_loc_desc:ntext',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                   'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['sub-location/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "sub-location/view", "Sub Locations", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['sub-location/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "sub-location/update", "Sub Locations", 'glyphicon glyphicon-edit','',$url);
                                         },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
