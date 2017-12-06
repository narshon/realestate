<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyIssueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="occupancy-issue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_occupancy_id') ?>

    <?= $form->field($model, 'fk_related_term') ?>

    <?= $form->field($model, 'issue_type') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, '_status') ?>

    <?php // echo $form->field($model, 'status_remarks') ?>

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
