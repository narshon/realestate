<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysUsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_group_id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'pass') ?>

    <?= $form->field($model, 'name1') ?>

    <?php // echo $form->field($model, 'name2') ?>

    <?php // echo $form->field($model, 'name3') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'date_added') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'color_code') ?>

    <?php // echo $form->field($model, 'icon_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
