<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\AccountsTransaction;
use app\models\Source;
use kartik\widgets\DatePicker;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */
/* @var $form yii\widgets\ActiveForm */
$view_name = 'journal';
$id = isset($model->id)?$model->id:0;
echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
?>

    <?php $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]); ?>
	<div class='row'>
	<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'><?=$form->field($model, 'date')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Select date ...'],
    'pluginOptions' => [
        'autoclose'=>true
    ]
]); ?></div>

     <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'> <?= $form->field($model, 'receipt_invoice_no')->textInput(['maxlength' => true]) ?></div>
		</div>
	<div class='row'>
      <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'><?= $form->field($model, 'cheque_no')->textInput(['maxlength' => true]) ?></div>
	
	  <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'><?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?></div>
     </div>
	<?= $form->field($model, 'transacted_by')->dropdownList(Users::getUsersOptions(),['prompt'=>'Select User']); ?>
	
	  <div class='row'>
	   
	 
      <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'> <?php echo $form->field($model, 'account_type')->dropDownList(app\models\Accounts::find()->select(['account_name', 'id'])->indexBy('id')->column(),['prompt'=>'Select Option']);?></div>
	
	  <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'> <?php echo  $form->field($model, 'transaction_type')->dropdownList(Source::getSourceAgentOptions(),['prompt'=>'Select Source']); 
	?>
	</div>
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
