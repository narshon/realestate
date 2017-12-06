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
    


    <?= $form->field($model, 'name1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropdownList(['Female'=>'Female','Male'=>'Male'],['prompt'=>'Select Gender']); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
     <?= $form->field($model, 'residence')->textInput(); ?>

    <?= $form->field($model, 'fk_management_id')->hiddenInput()->label("") ?>
    <?= $form->field($model, 'fk_group_id')->hiddenInput()->label("") ?>
    <?= $form->field($model, 'fk_sublet_id')->hiddenInput()->label("") ?>
    

    <?php 
      if($model->fk_sublet_id != ""){
          $url =  Url::to(["$view_name/setoccupanttenantform"]);
      }
      else{
          $url =  Url::to(["$view_name/tenantform",'id'=>$model->id]);
      }
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
