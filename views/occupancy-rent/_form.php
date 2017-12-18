<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyRent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="occupanty-rent-form" style="text-align: center">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
        <div class="header" style="border-bottom: 1px #505039 solid; padding-bottom: 30px;">
            <div class="col-md-4">
                <label>Property Name:</label>
                <?=$model->fkOccupancy->fkProperty->property_name ?>
            </div>
            <div class="col-md-4">
                <label>Property Unit:</label>
                <?=$model->fkOccupancy->fkSublet->sublet_name ?>
            </div>
            <div class="col-md-4">
                <label>Occupant:</label>
                <?=$model->fkOccupancy->fkTenant->getNames()?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'month')->dropdownList(
             app\utilities\DataHelper::getMonthOptions(),
            ['prompt'=>'Please Select']
        ); ?>
        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'year')->dropdownList(
             app\utilities\DataHelper::getYearOptions(),
            ['prompt'=>'Please Select']
        ); ?>
        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'fk_source')->dropdownList(
             app\models\Source::getTenantOptions(),
            ['prompt'=>'Please Select']
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
            <?php  // Usage with ActiveForm and model
            echo $form->field($model, '_status')->widget(Select2::classname(), [
                'data' => \app\models\Lookup::getLookupValues('Status'),
                'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);  ?>
        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>