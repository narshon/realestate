<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Locations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index">


    <p>
        <?php 
                      $dh = new DataHelper();
					  $url=Url::to(['location/create']);
                       echo $dh->getModalButton(new \app\models\Group, 'location/create', 'Locations', 'btn btn-danger btn-create',"New",$url,"Location");
                  ?>
    </p>
    <?php Pjax::begin(['id'=>'pjax-location',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_ward',
            'location_name',
            'location_desc:ntext',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['location/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "location/view", "Location", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['location/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "location/update", "Location", 'glyphicon glyphicon-edit','',$url);
                                            },
                            ], 
                    ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
