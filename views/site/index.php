<?php

/* @var $this yii\web\View */

$this->title = 'Real Estate Pro';
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use yii\helpers\Html;
?>
<div class="content-bar body-content">
        
        <?php
          //get all property types and create panels to display their properties.
          $types = \app\models\Lookup::find()->where(['category'=> app\models\LookupCategory::getLookupCategoryID("Property Type")])->all();
          if($types){
              foreach($types as $type){
                  ?>
                  <div class="panel panel-danger">
                      <div class="panel-heading"><?= $type->_value ?></div>
                    <div class="panel-body">
                        <div class="row">
                        <?php 
                            $dataProvider = new ActiveDataProvider([
                                 'query' => \app\models\Property::find()->where(['property_type'=>$type->_key]),
                             ]);
                            $dataProvider->pagination->pageSize=8;
                           echo  ListView::widget([
                                     'dataProvider' => $dataProvider,
                                     'itemOptions' => ['class' => 'item col-lg-4'],
                                     'itemView' => function ($model, $key, $index, $widget) {
                                             return $model->propertyPost();
                                     },
                             ]); 
                        ?>     
                         <div class="clear-thumbs"> &nbsp; </div>

                        </div>
                    </div>
                </div>
                  
                  <?php
              }
          }
        
        ?>
        
        
        
      

    </div>
<div class="sidebar-content">
    <div class="panel panel-danger">
           <div class="panel-heading">Featured Properties</div>
            <div class="panel-body">
                
                <div class="row">
                <?php 
                    $dataProvider = new ActiveDataProvider([
                         'query' => \app\models\Property::find(),
                     ]);
                    $dataProvider->pagination->pageSize=4;
                   echo  ListView::widget([
                             'dataProvider' => $dataProvider,
                             'itemOptions' => ['class' => 'item col-lg-12'],
                             'itemView' => function ($model, $key, $index, $widget) {
                                     return $model->propertyPost();
                             },
                     ]); 
                ?>     
                 <div class="clear-thumbs"> &nbsp; </div>

                </div>
            </div>
        </div>
</div>
</div>
