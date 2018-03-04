<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Estate */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'estate';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?php  // Usage with ActiveForm and model
        echo $form->field($model, 'fk_sub_location')->widget(Select2::classname(), [
            'data' => app\models\SubLocation::find()->select(['sub_loc_name', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_fk_sub_location'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ]);  ?></div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'estate_name')->textInput(['maxlength' => true]) ?></div>
</div>
    <?= $form->field($model, 'estate_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estate_review')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estate_media')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
