<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use app\models\PropertySublet;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Property Sublets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-sublet-index">

    <p>
        <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'property-sublet/create', 'Property Sublets', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-property-sublet', 'timeout' => 5000]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'fkProperty',
                'label' => 'Property',
                'value' => 'fkProperty.property_name'
            ],
            'sublet_name',
            'sublet_desc:ntext',
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
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "property-sublet/view", "Property Sublets", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "property-sublet/update", "Property Sublets", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
