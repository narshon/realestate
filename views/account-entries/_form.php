<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AccountEntries */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        
        $view_name = 'account-entries';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
    <?= $form->field($model, 'fk_account_chart')->dropDownList(\app\models\AccountChart::getExpensesOptions(), ['prompt' => '']) ?>

    <?= $form->field($model, 'amount')->textInput() ?>
    
    <?= $form->field($model, 'particulars')->textInput() ?>

   
  <?php echo $form->field($model, 'entry_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);   ?>


    <div class="form-group">
        <?php $url =  Url::to(["$view_name/create"]);  ?>
        <?= Html::submitButton('Add Expense', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>
    <p> &nbsp; </p>
    <p> &nbsp; </p>
    <p> &nbsp; </p>
    <p> &nbsp; </p>
    <p> &nbsp; </p>
</div>
