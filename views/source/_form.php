<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\source */
/* @var $form yii\widgets\ActiveForm */
$view_name = 'source';
$id = isset($model->id)?$model->id:0;
echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
?>



    <?php $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]); ?>
	<div class='row'>
	
     <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'><?= $form->field($model, 'source_name')->textInput(['maxlength' => true]) ?></div>
 <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'><?php echo $form->field($model, 'source_type')->dropDownList(['Expense' => 'Expense', 'Income' => 'Income'],['prompt'=>'Select Option']);?>
    </div>
 
 </div>
    <?php echo $form->field($model, 'category')->dropDownList(['tenant' => 'Tenant', 'landlord' => 'Landlord','agent' => 'Agent'],['prompt'=>'Select Option']);?>
    <?= $form->field($model, 'source_description')->textarea(['rows' => 6]) ?>

    

    <div class="form-group">
       <?php
$url = Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);
?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
