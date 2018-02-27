<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\PropertyArea;
use yii\data\ActiveDataProvider;
use app\models\PropertyFeature;
use app\models\PropertySublet;
use app\models\PropertyTerm;
use app\models\Property;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\PropertyAreaSearch;
use app\models\PropertyFeatureSearch;
use app\models\PropertySubletSearch;
use app\models\PropertyTermSearch;
use yii\helpers\Url;
use app\models\Estate;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Properties';
?>

<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2>Properties</h2>
        
    </div>


  
        <div class="property-index">
            
            <p> <br/>
                <?php 
                     //new properties are added from the landlord.
                     // $dh = new DataHelper();
                     //  echo $dh->getModalButton(new Property, "property/create", 'Property', 'btn btn-danger btn-create', 'New');
                ?>
            </p>
            <?php  Pjax::begin(['id'=>'pjax-property', 'timeout' => 5000]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
               // 'filterUrl'  => yii\helpers\Url::to(["property/index"]),
               /* 'rowOptions' => function ($model, $key, $index, $grid) {
                                        $url = Url::to(['property/view','id'=>$key]);
                                        return [ 'id' => $model->id, 'onclick' => "redirectTo('$url');" ];
                                },  */
                'columns' => [
                    /* [
                        'class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => function($model, $key, $index, $widget) {
                            return ['value' => $model->id, 'onclick'=>'alert("Here")'];
                         },
                    ], */
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'property_name',
                        'format' => 'raw',
                        'value' => function ($data) {
                              return $data->getPropertyNameLink();
                        },
                    ],
                    //'property_desc:ntext',
                              
                   
                     [
                     'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'attribute' => 'fk_property_location',
                    'filter'=> app\models\Estate::getEstateOptions(),
                    'header'=>'Property Location',
                    'format' => 'raw',
                    'value'=>function ($data) {
                               return isset($data->fkPropertyLocation->estate_name)?$data->fkPropertyLocation->estate_name:"";
                            },
                     ],           
                    [
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'attribute' => 'property_type',
                        'filter' => app\models\Lookup::getLookupValues('Property Type'),
                        'value' => function ($data) {
                            $category_id = \app\models\LookupCategory::getLookupCategoryID('Property Type');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->property_type);
                        },
                     ],
                    [
                        'attribute' => 'owner',
                        'value' => function ($data) {
							if(isset($data->owner)){
								return $data->owner->getNames();
							}
                              
                        },
                    ],
                    [
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'attribute' => '_status',
                        'filter' => app\models\Lookup::getLookupValues('Status'),
                        'value' => function ($data) {
                            $category_id = \app\models\LookupCategory::getLookupCategoryID('Property Status');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->_status);
                        },
                     ],
                     
                    // 'property_video_url:ntext',
                    // 'created_by',
                    // 'date_created',
                    // 'modified_by',
                    // 'date_modified',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                            $url = Url::to(['property/view','id'=>$model->id],true);
                                             $link = Html::a("",$url,['class'=>'glyphicon glyphicon-eye-open']);
                                              return $link;   
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['property/propertyform', 'management_id'=>$model->management_id,'owner_id'=>$model->owner_id, 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "property/propertyform", "Property", 'glyphicon glyphicon-edit','',$url);
                                    },
                            ], 

                    ],
                ],
            ]); ?>
            <?php  Pjax::end(); ?>
            <div id="tenantview-id"></div>
        </div>
         
      
    </div>
        
 


