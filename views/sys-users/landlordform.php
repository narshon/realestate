<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'sys-users';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
    <?= $form->field($model, 'fk_management_id')->hiddenInput()->label("") ?>
    <?= $form->field($model, 'fk_group_id')->hiddenInput()->label("") ?>
    

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><?= $form->field($model, 'name1')->textInput(['maxlength' => true]) ?></div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><?= $form->field($model, 'name2')->textInput(['maxlength' => true]) ?></div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><?= $form->field($model, 'name3')->textInput(['maxlength' => true]) ?></div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'gender')->dropdownList(['Female'=>'Female','Male'=>'Male'],['prompt'=>'Select Gender']); ?></div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'id_number')->textInput(['maxlength' => true]) ?></div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?></div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
</div>
    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
     <?= $form->field($model, 'residence')->textInput(); ?>

    


    <div class="form-group">
        <?php $url =  Url::to(["$view_name/landlordform",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
