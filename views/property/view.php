<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\utilities\DataHelper;
use app\models\CarImages;

use edofre\sliderpro\models\Slide;
use edofre\sliderpro\models\slides\Caption;
use edofre\sliderpro\models\slides\Image;
use edofre\sliderpro\models\slides\Layer;

/* @var $this yii\web\View */
/* @var $model app\models\car */

?>
<div class="onerow">
   <!-- <div class="col3">  -->
     <?php
     $datahelper = new DataHelper();
     // echo $datahelper->showRightSideBar(Yii::$app->controller);  
     ?>
   <!--  </div>   -->
     <div class="col12 last">
         <div class="onerow">
             <div class="col12 car-image-pane">
                 <div class="panel panel-info">
                    <div class="panel-heading"><?= $model->title ?></div>
                    <div class="onerow panel-body">
                        <div class="col8 car-image-pane">
                            <?php
                                //get images for this car.
                                $slides = []; $thumbnails = [];
                                $carImages = CarImages::find()->where(['fk_car'=>$model->id])->all();
                                if($carImages){
                                    
                                    foreach($carImages as $image){
                                        $slides[] = new Slide([
                                               'items' => [
                                                   new Image(['src' => $image->image_url]),
                                                   new Caption(['tag' => 'p', 'content' => $image->image_name]),
                                               ],
                                           ]);
                                        $thumbnails[] = new \edofre\sliderpro\models\Thumbnail(['tag' => 'img', 'htmlOptions' => ['src' => $image->image_url, 'data-src' => $image->image_url]]);
                                    }
                                }
                                
                                       ?>

                                       <?= \edofre\sliderpro\SliderPro::widget([
                                           'id'            => 'my-slider',
                                           'slides'        => $slides,
                                           'thumbnails'    => $thumbnails,
                                           'sliderOptions' => [
                                               'width'  => 960,
                                               'height' => 500,
                                               'arrows' => true,
                                               'init'   => new \yii\web\JsExpression("
                                                   function() {
                                                       console.log('slider is initialized');
                                                   }
                                               "),
                                           ],
                                       ]);
                                       
                                 //show buttons for Order/Inquire
                                 //show inquiry form
                                    $inquire_url = yii\helpers\Url::to(['inquiry/create']);
                                    $inquire = Html::a('<button type="button" class="btn btn-info btn-lg">Inquire </button>', ['#'], ['class' => '',  'onclick'=>"showInquiryDialog('$inquire_url',$model->id); return false;"]);
                                    $order_url = yii\helpers\Url::to(['order/create']);
                                    $login_url = yii\helpers\Url::to(['site/loginform']);
                                    //check if user already logged in to show order form, if not, show login form first.
                                    if(!Yii::$app->user->isGuest)
                                     $order = Html::a('<button type="button" class="btn btn-success btn-lg">Order </button>', ['#'], ['class' => '',  'onclick'=>"showOrderDialog('$order_url','$model->id'); return false;"]);
                                    else
                                      $order = Html::a('<button type="button" class="btn btn-success btn-lg">Order </button>', ['#'], ['class' => '',  'onclick'=>"showLoginDialog('$login_url', '$model->id'); return false;"]);

                                   echo $inquire.' '.$order;
                                   ?>
                        </div>
                        <div class="col4 last car-details-pane">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id',
                                    [
                                       'label'=>'Make',
                                       'value'=>app\models\LookupCategory::getLookupCategoryValue(\app\models\Category::getLookupCategoryID('Make'), $model->make),
                                    ],
                                    [
                                       'label'=>'Model',
                                       'value'=>app\models\LookupCategory::getLookupCategoryValue(\app\models\Category::getLookupCategoryID('Model'), $model->model),
                                    ],
                                    [
                                       'label'=>'Body Type',
                                       'value'=>app\models\LookupCategory::getLookupCategoryValue(\app\models\Category::getLookupCategoryID('bodytype'), $model->bodytype),
                                    ],
                                    'year_manufactured',
                                    'Engine_cc',
                                    'tonne',
                                    'exterior_color:ntext',
                                    'door_count',
                                    'price',
                                    [
                                       'label'=>'Drive Type',
                                       'value'=>app\models\LookupCategory::getLookupCategoryValue(\app\models\Category::getLookupCategoryID('drive_type'), $model->drive_type),
                                    ],
                                    [
                                       'label'=>'Transmission',
                                       'value'=>app\models\LookupCategory::getLookupCategoryValue(\app\models\Category::getLookupCategoryID('transmission'), $model->transmission),
                                    ],
                                    [
                                       'label'=>'Engine Type',
                                       'value'=>app\models\LookupCategory::getLookupCategoryValue(\app\models\Category::getLookupCategoryID('engine_type'), $model->engine_type),
                                    ],
                                    [
                                       'label'=>'Status',
                                       'value'=>app\models\LookupCategory::getLookupCategoryValue(\app\models\Category::getLookupCategoryID('status'), $model->_status),
                                    ],
                                ],
                            ]) ?>

                        </div>   
                    </div>
                    <div class="onerow panel-body">
                        <div class="col12 recommended-cars-pane">
                            <?php
                            
                            echo app\vendor\etag\RecommendedWidget\RecommendedWidget::widget();
                            
                            ?>
                        </div>
                    </div>
                  </div>
                 
             </div>
             
         </div>   
         
         
    </div>
</div>

