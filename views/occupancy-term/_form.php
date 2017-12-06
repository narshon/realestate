<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyTerm */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'occupancy-term';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

    <?= $form->field($model, 'fk_property_term_id')->dropdownList(
         app\models\PropertyTerm::getPropertyTermsOptions($model->getPropertyID($model->fk_occupancy_id)),
        ['prompt'=>'Please Select']
    ); ?>
    <?php echo $form->field($model, 'term_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);   ?>
    <?php echo $form->field($model, 'date_signed')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);   ?>
    <?= $form->field($model, 'value')->textInput() ?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>

    <div class="form-group">
        <?php if($model->isNewRecord){
            $url =  Url::to(["$view_name/create",'occupancy_id'=>$model->id]);  
        }
        else{
            $url =  Url::to(["$view_name/update",'id'=>$model->id]);  
        }  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>
    <?= $form->field($model, 'fk_occupancy_id')->hiddenInput()->label("") ?>
    <?php ActiveForm::end(); ?>

</div>
