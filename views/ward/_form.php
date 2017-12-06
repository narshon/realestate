<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Ward */
/* @var $form yii\widgets\ActiveForm */
?>

<?php   $id = isset($model->id)?$model->id:0; ?>
<div class="ward-form" id="ward-form-div-<?= $id ?>">

    <?php $form = ActiveForm::begin(['id'=>'ward-form-'.$id]); ?>
    <div id="ward-form-alert-<?= $id ?>">
      
    </div>

   <?php  // Usage with ActiveForm and model
       /* echo $form->field($model, 'fk_subcounty')->widget(Select2::classname(), [
            'data' => app\models\Subcounty::find()->select(['subcounty_name', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_fk_subcounty'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); */ ?>
        <?php echo $model->ward_name; ?>
    <?= $form->field($model, 'ward_name')->textInput(['maxlength' => true]) ?>
    <?php // echo $form->field($model, 'ward_name')->textInput(['maxlength' => true]) ?>
     
    <?php // echo $form->field($model, 'ward_desc')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? 'ward/create' : 'ward/update','id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','ward-form-div-$id','ward-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
