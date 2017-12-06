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
 <?php echo $form->field($model, 'fk_property_id')->dropDownList(app\models\Property::find()->select(['property_name', 'id'])->indexBy('id')->column(), ['id'=>'property-id'])->label("Property");  ?>
   
    <?php  // Usage with ActiveForm and model
        echo $form->field($model, 'fk_sublet_id')->widget(DepDrop::classname(), [
            'type'=>DepDrop::TYPE_SELECT2,
            'data' => app\models\PropertySublet::find()->select(['sublet_name', 'id'])->indexBy('id')->column(),
            'options'=>['id'=>'fk-sublet-id', ],
            'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
            'pluginOptions'=>[
                'depends'=>['property-id'],
                'placeholder'=>'Select...',
                'url'=>Url::to(['/occupancy/sublets'])
            ]
        ]);  ?>

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

    <div class="form-group">
        <?php 
          if($model->isNewRecord){
             $url =  Url::to(["$view_name/create",'fk_user_id'=>$model->fk_user_id]);
          }
          else{
              $url =  Url::to(["$view_name/update",'id'=>$model->id]);
          }
        ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
