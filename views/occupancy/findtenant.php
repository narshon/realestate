<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Occupancy */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'occupancy';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
    <?= $form->field($model, 'name1')->textInput() ?>
    <?= $form->field($model, 'name2')->textInput() ?>
    <?= $form->field($model, 'name3')->textInput() ?>
    <?= $form->field($model, 'phone')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'id_number')->textInput() ?>

    <?= $form->field($model, 'fk_sublet_id')->hiddenInput()->label("") ?>

    <div class="form-group">
        <?php 
          
              $url =  Url::to(["occupancy/set",'fk_sublet_id'=>$model->fk_sublet_id]);
        ?>
        <?= Html::submitButton('Find', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
