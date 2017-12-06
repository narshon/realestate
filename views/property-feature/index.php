<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\PropertyFeature;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Property Features';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-feature-index">
    <h3> <?php echo $this->title; ?> </h3>
    <p>
             <?php 
                      $dh = new DataHelper();
                      $url = Url::to(['property-feature/create', 'fk_property_id'=>$property->id]);
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'property-feature/create', 'Property Features', 'btn btn-danger btn-create','New',$url);
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-property-feature', 'timeout' => 5000]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'fkFeature',
                'label' => 'Feature',
                'value' => 'fkFeature.feature_name'
            ],
            [
                'attribute' => 'fkProperty',
                'label' => 'Property',
                'value' => 'fkProperty.property_name'
            ],
            [
                'attribute' => 'fkSublet',
                'label' => 'Sublet',
                'value' => 'fkSublet.sublet_name'
            ],
            'feature_narration:ntext',
            // 'feature_video_url:ntext',
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'attribute' => '_status',
                'filter' => app\models\Lookup::getLookupValues('Status'),
                'value' => function ($data) {
                    $category_id = \app\models\LookupCategory::getLookupCategoryID('Status');
                    return app\models\Lookup::getLookupCategoryValue($category_id, $data->_status);
                },
            ],
            // 'created_by',
            // 'date_created',
            // 'modified_by',
            // 'date_modified',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['property-feature/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "property-feature/view", "Property Features", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['property-feature/update', 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "property-feature/update", "Property Features", 'glyphicon glyphicon-edit','',$url);
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
