<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\utilities\DataHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Property Feature Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-feature-image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'property-feature-image/create', 'Property Feature Images', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-property-feature-image', 'timeout' => 5000]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'fkPropertyFeature',
                'label' => 'Property Feature',
                'value' => 'fkPropertyFeature.fkFeature.feature_name'
            ],
            'image_url:ntext',
            'image_title',
            'image_caption:ntext',
            // '_status',
            // 'date_created',
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "property-feature-image/view", "Property Feature Images", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "property-feature-image/update", "Property Feature Images", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
