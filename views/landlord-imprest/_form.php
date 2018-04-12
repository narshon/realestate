<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\LandlordImprest */
/* @var $form yii\widgets\ActiveForm */
?><?php 
        use yii\helpers\Url;
        $view_name = 'landlord-imprest';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

  <?php echo   $form->field($model, 'fk_landlord')->hiddenInput()->label(false);  ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'amount')->textInput() ?></div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
     <?php echo $form->field($model, 'entry_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter entry date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);   ?>
    </div>
</div>
<?php echo   $form->field($model, 'narration')->textInput()->label("Narration");  ?>
     <?php  // Usage with ActiveForm and model
       /* echo $form->field($model, 'imprest_type')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Imprest Type'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_imprest_type'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); */ ?>
	<?php echo   $form->field($model, 'imprest_type')->hiddenInput()->label(false);  ?>

    <?php echo   $form->field($model, '_status')->hiddenInput()->label(false);  ?>

   <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>


    <?php ActiveForm::end(); ?>

</div>
