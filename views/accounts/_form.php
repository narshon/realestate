<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\accounts */
/* @var $form yii\widgets\ActiveForm */

$view_name = 'accounts';
$id = isset($model->id)?$model->id:0;
echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
?>

    <?php $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]); ?>
	
	<div class='row'>
	
	<div class='col-xs-12 col-sm-12 col-md-4 col-lg-6'> <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?></div>

   <div class='col-xs-12 col-sm-12 col-md-4 col-lg-6'> <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?> </div>
	</div>

    <?= $form->field($model, 'account_description')->textarea(['rows' => 6]) ?>

   <div class='row'>

    <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'><?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?></div>

    <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'><?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?></div>

   <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'> <?= $form->field($model, 'bank_code')->textInput(['maxlength' => true]) ?></div>

    </div>

    <div class="form-group">
	<?php
$url = Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);
?>
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
 
      </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
