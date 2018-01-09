<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccountEntries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-entries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_account_chart')->textInput() ?>

    <?= $form->field($model, 'trasaction_type')->dropDownList([ 'credit' => 'Credit', 'debit' => 'Debit', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'entry_date')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
