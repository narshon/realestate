<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WardOneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ward-one-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_subcounty') ?>

    <?= $form->field($model, 'ward_name') ?>

    <?= $form->field($model, 'ward_desc') ?>

    <?= $form->field($model, 'ward_lat') ?>

    <?php // echo $form->field($model, 'ward_long') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
