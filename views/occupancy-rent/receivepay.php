<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

?>
<?php 
        use yii\helpers\Url;
        $view_name = 'occupancy-rent';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

    <?= $form->field($model, 'amount_paid')->textInput() ?>
    <?php echo $form->field($model, 'account_type')->dropDownList(app\models\Accounts::find()->select(['account_name', 'id'])->indexBy('id')->column(),['prompt'=>'Select Option']);?>
    <?= $form->field($model, 'date_paid')->textInput() ?>
    <?= $form->field($model, 'receipt_no')->textInput() ?>
    <?= $form->field($model, 'cheque_no')->textInput() ?>
    <?= $form->field($model, 'details')->textInput() ?>

   

<div class="form-group">
        <?php 
            $url =  Url::to(["$view_name/receivepay",'occupancy_id'=>$model->fk_occupancy_id]);  
        ?>
        <?= Html::submitButton( 'Receive', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>
    <?= $form->field($model, 'fk_occupancy_id')->hiddenInput()->label("") ?>
    <?php ActiveForm::end(); ?>

</div>