<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="occupancy-payments-form" style="text-align: center">

    <?php $form = ActiveForm::begin(['id' => 'occupancy-payments']); ?>
    <div class="row header" style="border-bottom: 1px #505039 solid; padding-bottom: 30px;">
        <div class="col-md-4">
            <label>Tenant:</label>
            <?= \app\models\Occupancy::getDetail($model->fk_occupancy_id, 'name')?>
        </div>
        <div class="col-md-4">
            <label>Property:</label>
            <?= \app\models\Occupancy::getDetail($model->fk_occupancy_id, 'property')?>
        </div>
        <div class="col-md-4">
            <label>Sublet:</label>
            <?= \app\models\Occupancy::getDetail($model->fk_occupancy_id, 'sublet')?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'payment_method')->dropdownList(
             \app\models\Lookup::getLookupValues('Payment Method'),
                    ['prompt'=>'--select--']
                ); ?>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>
    <div class="col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'ref_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>
    <div class="col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'payment_date')->widget(DatePicker::className(), [
                'dateFormat' => 'php:Y-m-d',
                'options'=>[
                    'class'=>'form-control'
                    ], 
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true, 
                    'maxDate'=>'today',
                    'defaultDate'=>'today',
                    ]
            ])?>
        </div>
        <div class="col-md-4"></div>
        
    </div>
    <div class="col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropdownList(
             \app\models\Lookup::getLookupValues('Payment Status'),
                    ['prompt'=>'--select--']
                ); ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>
    <div class="form-group">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= Html::submitButton('Receive', ['class' => 'btn btn-danger showModalButton']) ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
