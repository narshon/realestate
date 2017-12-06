<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\PropertyTerm;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Property Terms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-term-index">
    <h3> <?php echo $this->title; ?> </h3>
    <p>
        <?php 
                      $dh = new DataHelper();
                      $url = Url::to(['property-term/create', 'fk_property_id'=>$property->id]);
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'property-term/create', 'Property Terms', 'btn btn-danger btn-create','New',$url);
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-property-term', 'timeout' => 5000]); ?> 
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
            [
                'attribute' => 'fkTerm',
                'label' => 'Term',
                'value' => 'fkTerm.term_name'
            ],
            'term_title',
            'term_value',
            // 'action_handler',
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
                                             $url = Url::to(['property-term/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "property-term/view", "Property Terms", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['property-term/update', 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "property-term/update", "Property Terms", 'glyphicon glyphicon-edit','',$url);
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
