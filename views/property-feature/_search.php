<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyFeatureSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-feature-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_feature') ?>

    <?= $form->field($model, 'fk_property_id') ?>

    <?= $form->field($model, 'fk_sublet_id') ?>

    <?= $form->field($model, 'feature_narration') ?>

    <?php // echo $form->field($model, 'feature_video_url') ?>

    <?php // echo $form->field($model, '_status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <?php // echo $form->field($model, 'date_modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
