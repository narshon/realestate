<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\WardOne */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
        use yii\helpers\Url;
        $view_name = 'ward-one';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>         
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'fk_subcounty')->widget(Select2::classname(), [
            'data' => app\models\Subcounty::find()->select(['subcounty_name', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_fk_subcounty'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?></div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'ward_name')->textInput(['maxlength' => true]) ?></div>
</div>
    <?= $form->field($model, 'ward_desc')->textarea(['rows' => 6]) ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'ward_lat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?= $form->field($model, 'ward_long')->textInput(['maxlength' => true]) ?></div>
</div>
     <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
