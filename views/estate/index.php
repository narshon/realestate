<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\utilities\DataHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-index">

    <p>
        <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\Estate, 'estate/create', 'Estate', 'btn btn-danger btn-create');
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
                                              $popup = $dh->getModalButton($model, "estate/view", "Estate", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "estate/update", "Estate", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
