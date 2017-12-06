<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccountsTransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-transaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_journal') ?>

    <?= $form->field($model, 'fk_account') ?>

    <?= $form->field($model, 'fk_source') ?>

    <?= $form->field($model, 'dr') ?>

    <?php // echo $form->field($model, 'cr') ?>

    <?php // echo $form->field($model, 'running_balance') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'date_modified') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
