<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyFeature */

 $this->title = $model->id;
/*
$this->params['breadcrumbs'][] = ['label' => 'Property Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;  */
?>
<div class="property-feature-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
               'label'=>'Feature',
               'value'=>$model->fkFeature->feature_name,
            ],
            [
               'label'=>'Property',
               'value'=>$model->fkProperty->property_name,
            ],
            [
               'label'=>'Sublet',
               'value'=>isset($model->fkSublet->sublet_name)?$model->fkSublet->sublet_name:"",
            ],
            'feature_narration:ntext',
            'feature_video_url:ntext',
            [                      // the owner name of the model
             'label' => 'Status',
             'value' => app\models\Lookup::getLookupCategoryValue(\app\models\LookupCategory::getLookupCategoryID('Status'), $model->_status),
            ],
            
        ],
    ]) ?>

</div>

<div class="property-feature-image-upload">
    
<div class="panel panel-danger">
   <div class="panel-heading">
        Feature Images
        <?php
            $url =  Url::to(['property-feature-image/create', 'property_feature_id'=>$model->id]);
            echo Html::Button("Add New", ['class' =>'btn btn-danger btn-create btn-property-feature-image','onclick'=>" ajaxUniversalGetRequest('$url','image-div','', 1); return false;"]); 
          ?>
    </div>  
    <div class="panel-body">
        
    <!-- render all existing images here --->
    <?= $this->render('//property-feature-image/show', [
        'property_feature_id' => $model->id,
    ]) ?>
    
    </div>
</div>
    
<div id="image-div">
    
</div>
    
</div>