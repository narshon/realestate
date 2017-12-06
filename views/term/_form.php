<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Term */
/* @var $form yii\widgets\ActiveForm */
?>

<?php   $id = isset($model->id)?$model->id:0; ?>
<div class="term-form" id="term-form-div-<?= $id ?>">

    <?php $form = ActiveForm::begin(['id'=>'term-form-'.$id]); ?>
    <div id="term-form-alert-<?= $id ?>"></div>

    

    <?= $form->field($model, 'term_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'term_desc')->textarea(['rows' => 6]) ?>

   

     <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? 'term/create' : 'term/update','id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','term-form-div-$id','term-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
