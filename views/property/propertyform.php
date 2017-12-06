<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use kartik\widgets\Select2;
use app\models\Estate;

/* @var $this yii\web\View */
/* @var $model app\models\Property */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->registerCssFile(\Yii::$app->request->BaseUrl."/css/select2.min.css", [
    'depends' => [],
    'media' => 'print',
], 'css-print-theme');
?>
<?php   $id = isset($model->id)?$model->id:0; ?>
<div class="property-form" id="property-form-div-<?= $id ?>">
    
    <?php $form = ActiveForm::begin(['id'=>'property-form-'.$id]); ?>
     <div id="property-form-alert-<?= $id ?>">
      
    </div>

    <?= $form->field($model, 'property_name')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'property_type')->textInput() ?>
    <?php  // Usage with ActiveForm and model
        echo $form->field($model, 'property_type')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Property Type'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_property_type'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>
    
    <?= $form->field($model, 'property_desc')->textarea(['rows' => 2]) ?>  

    <?= $form->field($model, 'fk_property_location')->dropdownList(Estate::getEstateOptions(),['prompt'=>'Select Estate']); ?>

      
        <?= $form->field($model, 'management_id')->hiddenInput()->label("") ?>
        <?= $form->field($model, 'owner_id')->hiddenInput()->label("") ?>
    


    <div class="form-group">
        <?php $url =  Url::to(['property/propertyform','management_id'=>$model->management_id,'owner_id'=>$model->owner_id,'id'=>$model->id]);  ?>
        
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','property-form-div-$id','property-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>


