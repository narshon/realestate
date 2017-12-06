<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyRent */
/* @var $form yii\widgets\ActiveForm */
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

   
    <?= $form->field($model, 'fk_occupancy_id')->dropdownList(
         app\models\Occupancy::getOccupancyOptions(),
        ['prompt'=>'Please Select']
    ); ?>

    <?= $form->field($model, 'month')->dropdownList(
         app\utilities\DataHelper::getMonthOptions(),
        ['prompt'=>'Please Select']
    ); ?>

    <?= $form->field($model, 'year')->dropdownList(
         app\utilities\DataHelper::getYearOptions(),
        ['prompt'=>'Please Select']
    ); ?>

    <?= $form->field($model, 'pay_rent_due')->textInput() ?>

    <?= $form->field($model, 'balance_due')->textInput() ?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>


    <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
