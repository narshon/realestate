<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \app\models\PropertyArea;
use app\utilities\DataHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Property Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-area-index">

    <p>
        
        <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\PropertyArea, 'property-area/create', 'Property Areas', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-property-area', 'timeout' => 5000]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                        'attribute' => 'property',
                        'value' => 'property.property_name'
            ],
            [
                        'attribute' => 'subLocation',
                        'value' => 'subLocation.sub_loc_name'
            ],
            [
                        'attribute' => 'estate',
                        'value' => 'estate.estate_name'
            ],
            'area_desc:ntext',
            [
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'attribute' => '_status',
                        'filter' => app\models\Lookup::getLookupValues('Status'),
                        'value' => function ($data) {
                            $category_id = \app\models\LookupCategory::getLookupCategoryID('Status');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->_status);
                        },
                     ],
            // 'date_created',
            // 'date_modified',
            // 'created_by',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "property-area/view", "Property Areas", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "property-area/update", "Property Areas", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
