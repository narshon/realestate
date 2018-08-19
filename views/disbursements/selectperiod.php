<?php
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\Url;

$this->registerJs('processDStatus();')
?>

<div class="section">
   <?php 
        $view_name = 'disbursements';
        $id = isset($model->id)?$model->id:0;
?>
        <div class="<?= $view_name ?>-form " id="<?= $view_name ?>-select-form-div-<?= $id ?>">
              <div id="<?= $view_name ?>-form-alert-<?= $id ?>"></div>

   <?php   $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <div><label for="period">Select Period </label></div>
                <?=  $form->field($model, 'period')->widget(Select2::classname(), [
            'data' => app\models\Disbursements::getPeriodOptions($owner_id),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_period'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label("");  ?>
            </div>
            <div class="col-md-4">
                <div class="processing" style='display:none;text-align:left; margin-top: 30px !important;'>  <?=Html::img('@web/images/radio.gif')?></div>
            </div>
            
        </div>
        <div class="col-md-12">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4 payment-calculator">
                
            </div>
            
        </div>
    </div>
    <div class="form-group" style="padding-top:15px;">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center">
            <?php // Html::submitButton('Submit Disbursements', ['class' => 'btn btn-primary','id'=>'map-btn']) ?>
            <?php $url =  Url::to([ "$view_name/select-period",'owner_id'=>$owner_id]);  ?>
        <?= Html::submitButton("Submit Disbursements", ['class' =>'btn btn-primary','id'=>'map-btn', 'onclick'=>"ajaxFormSubmit('$url','$view_name-select-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>