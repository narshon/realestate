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
        echo $form->field($model, 'management_id')->widget(Select2::classname(), [
            'data' => app\models\Management::find()->select(['management_name', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_management_id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>
 
        <?php  // Usage with ActiveForm and model
        echo $form->field($model, 'owner_id')->widget(Select2::classname(), [
            'data' => app\models\Users::find()->select(['name1', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_owner_id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'fk_property_location')->dropdownList(Estate::getEstateOptions(),['prompt'=>'Select Estate']); ?></div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?php  // Usage with ActiveForm and model
             echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Property Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ]);  ?></div>
        </div>
    
    <?= $form->field($model, 'property_desc')->textarea(['rows' => 4]) ?>  

    

    <?= $form->field($model, 'property_video_url')->textarea(['rows' => 2]) ?>


    <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? 'property/create' : 'property/update','id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','property-form-div-$id','property-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>


