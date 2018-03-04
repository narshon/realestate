<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'entry_date')->textInput() ?></div>
</div>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, '_status')->dropDownList(
            [1=>"Paid", 0=>"Pending"],['prompt'=>"Select Status"])
        ?>

   <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>


    <?php ActiveForm::end(); ?>

</div>
