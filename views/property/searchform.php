<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\field\FieldRange;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Property */
/* @var $form yii\widgets\ActiveForm */

$datahelper = new \app\utilities\DataHelper;
?>

<div  id="property-search-form-div" class="property-search-form-div">
    <?php $form = ActiveForm::begin(['id'=>"property-search-form"]); ?>
  
    <div class="property-search-form-field">
        <strong>Property Type </strong><br/><?= 
         $form->field($model, 'property_type')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Property Type'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_property_type'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
    ?>
      </div>
      <div class="property-search-form-field">
          <strong>Location </strong><br/><?php 
        echo $form->field($model, 'search_sub_location')->widget(Select2::classname(), [
            'data' => \app\models\Location::getLocationSearchOptions(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_search_sub_location'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false); ?>
      </div>
      <div class="property-search-form-field">
         <?= 
          FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => 'Price Range',
            'attribute1' => 'search_price_range1',
            'attribute2' => 'search_price_range2',
            'options' => ['id'=>'select2_search_price_range'],
            'type' => FieldRange::INPUT_DROPDOWN_LIST,
            'items1' => [''=>'From']+$datahelper->calculateRangeWithIntervals(500, 30000,500),
            'items2' => [''=>'To'] +$datahelper->calculateRangeWithIntervals(500, 30000,500),
        ]); ?>
      </div>
    <div class="property-search-form-field">
        <?php
          $url = Url::to(["property/search"]);
        ?>
        <?= Html::Button('Search', ['class' =>'btn btn-danger btn-sm', 'onclick'=>"ajaxFormSubmit('$url','property-search-form-div','property-search-form',1,1); return false;"]) ?>
      </div>

    <?php ActiveForm::end(); ?>

</div>
