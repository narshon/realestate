<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\utilities\DataHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-index">

    <p>
        <?php 
                     $dh = new DataHelper();
						 $url=Url::to(['estate/create']);
                       echo $dh->getModalButton(new \app\models\Estate, 'estate/create', 'Estate', 'btn btn-danger btn-create' , "New",$url,"Estate");
                  ?>
    </p>
<?php Pjax::begin(['id'=>'pjax-estate',]); ?>   
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_sub_location',
            'estate_name',
            'estate_desc:ntext',
            'estate_review:ntext',
            // 'estate_media:ntext',
            // 'date_created',
            // 'date_modified',
            // 'created_by',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
											'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['estate/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "estate/view", "Estate", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
										 $dh = new DataHelper();
										 $url = Url::to(['estate/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "estate/update", "Estate", 'glyphicon glyphicon-edit','',$url,'Estate');
                                   
                                    },
                            ], 
                    ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
