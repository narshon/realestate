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

    <?= $form->field($model, 'fk_landlord')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'entry_date')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, '_status')->dropDownList(
            [1=>"Advance", 0=>"Pending"],['prompt'=>"Select Status"])
        ?>

   <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>


    <?php ActiveForm::end(); ?>

</div>
