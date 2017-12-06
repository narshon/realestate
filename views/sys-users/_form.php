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
    <?= $form->field($model, 'fk_management_id')->dropdownList(
         app\models\Management::find()->select(['management_name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Please Select']
    ); ?>

    <?= $form->field($model, 'fk_group_id')->dropdownList(
         app\models\Group::find()->select(['group_name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Select group']
    ); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'confirmpass')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gender')->dropdownList(['Female'=>'Female','Male'=>'Male'],['prompt'=>'Select Gender']); ?>


    <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
