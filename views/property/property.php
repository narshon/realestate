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
                      $dh = new DataHelper();
                      $url = Url::to(['property/propertyform','management_id'=>$landlord->fk_management_id,'owner_id'=>$landlord->id]);
                       echo $dh->getModalButton(new Property, "property/propertyform", 'Property', 'btn btn-danger btn-create', 'New',$url);
                ?>
            </p>
            <?php  Pjax::begin(['id'=>'pjax-property', 'timeout' => 5000]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
               // 'filterUrl'  => yii\helpers\Url::to(["property/index"]),
                'rowOptions' => function ($model, $key, $index, $grid) {
                                        $url = Url::to(['occupancy/tenant','property_id'=>$model->id]);
                                        return [ 
                                                'id' => $model->id, 
                                                'onclick' => "ajaxUniversalGetRequest('$url','tenantview-id','', 1);" 
                                                
                                              ];
                                },
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
                    'property_desc:ntext',
                    'fk_property_location:ntext',
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
                        'attribute' => 'management',
                        'value' => 'management.management_name'
                     ],
                    [
                        'attribute' => 'owner',
                        'value' => function ($data) {
                              return $data->owner->getNames();
                        },
                    ],
                    [
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'attribute' => '_status',
                        'filter' => app\models\Lookup::getLookupValues('Status'),
                        'value' => function ($data) {
                            $category_id = \app\models\LookupCategory::getLookupCategoryID('Status');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->_status);
                        },
                     ],
                     
                   
                ],
            ]); ?>
            <?php  Pjax::end(); ?>
            <div id="tenantview-id"></div>
        </div>
         
      
    </div>
        
 


