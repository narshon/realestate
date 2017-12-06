<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Journal;
use app\models\Accounts;
use app\models\Source;

/* @var $this yii\web\View */
/* @var $model app\models\AccountsTransaction */
/* @var $form yii\widgets\ActiveForm */
$view_name = 'accounts-transaction';
$id = isset($model->id)?$model->id:0;
echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
?>

    <?php $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]); ?>
	
	<div class='row'>
	<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'><?php echo  $form->field($model, 'fk_journal')->dropdownList(Journal::getJournalOptions(),['prompt'=>'Select Journal']); 
	?> </div>
   
<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'><?php echo  $form->field($model, 'fk_account')->dropdownList(Accounts::getAccountOptions(),['prompt'=>'Select Accounts']); 
	?> </div>
	<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'><?php echo  $form->field($model, 'fk_source')->dropdownList(Source::getSourceOptions(),['prompt'=>'Select Source']); 
	?> </div>
    
	</div>
	
	<div class='row'>
    <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'><?= $form->field($model, 'dr')->textInput(['maxlength' => true]) ?></div>

    <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'><?= $form->field($model, 'cr')->textInput(['maxlength' => true]) ?></div>

    <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'><?= $form->field($model, 'running_balance')->textInput(['maxlength' => true]) ?></div>
</div>
    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

  

    <div class="form-group">
        <?php
$url = Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);
?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
