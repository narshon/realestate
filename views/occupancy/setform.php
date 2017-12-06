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
   <?php
      //display some key values here to aide in decision making.
      echo "Property: ".app\models\Property::getName($model->fk_property_id)."<br/>";
      echo "Sublet: ". app\models\PropertySublet::getSubletName($model->fk_sublet_id)."<br/>";
      echo "Tenant: ". app\models\Users::getStaticName($model->fk_user_id)."<br/>";
   
   ?>
   <?php echo $form->field($model, 'start_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter start date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);   ?>

    <?php echo $form->field($model, 'end_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter end date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);   ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>

    <?= $form->field($model, 'fk_user_id')->hiddenInput()->label("") ?>
    <?= $form->field($model, 'fk_property_id')->hiddenInput()->label("") ?>
    <?= $form->field($model, 'fk_sublet_id')->hiddenInput()->label("") ?>

    <div class="form-group">
        <?php 
             $url =  Url::to(["$view_name/setform"]);
          
        ?>
        <?= Html::submitButton('Assign Occupancy', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
