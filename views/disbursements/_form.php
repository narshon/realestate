<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Disbursements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disbursements-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_occupancy_rent')->textInput() ?>

    <?= $form->field($model, 'fk_landlord')->textInput() ?>

    <?= $form->field($model, 'batch_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'entry_date')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, '_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
