<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */
/* @var $form yii\widgets\ActiveForm */
$view_name = 'account-entries';
$id = isset($model->id)?$model->id:0;
echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert"></div>
EOD;
?>
    <?php $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]); ?>
        <div class='row'>
            <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
                 <?php  // Usage with ActiveForm and model
                    echo $form->field($model, 'account_from')->widget(Select2::classname(), [
                        'data' => \app\models\AccountChart::getFundAccounts(),
                        'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_account_from'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);  ?> 
            </div>
            <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
                 <?php  // Usage with ActiveForm and model
                    echo $form->field($model, 'account_to')->widget(Select2::classname(), [
                        'data' => \app\models\AccountChart::getAllFundAccounts(),
                        'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_account_to'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);  ?> 
            </div>
        </div>
	
        <div class='row'>
           <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'><?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?></div>
             <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
               <?= $form->field($model, 'entry_date')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Select date ...'],
                        'pluginOptions' => [
                            'autoclose'=>true
                        ]
                    ]); ?>
            </div>
       </div>
	<div class='row'>
            
       </div>
	


    <div class="form-group">
       <?php
        $url = Url::to(['transfer']);
        ?>
        <?= Html::submitButton("Transfer Funds", ['class' =>'btn btn-danger btn-create pull-right','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>
    <?php ActiveForm::end(); ?>

</div>
