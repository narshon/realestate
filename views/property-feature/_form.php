<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyFeature */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'property-feature';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, 'fk_feature')->widget(Select2::classname(), [
            'data' => app\models\Feature::find()->select(['feature_name', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_fk_feature'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>

    <?php  // Usage with ActiveForm and model
       /* echo $form->field($model, 'fk_sublet_id')->widget(Select2::classname(), [
            'data' => app\models\PropertySublet::find()->select(['sublet_name', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_fk_sublet_id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  */  ?>

    <?= $form->field($model, 'feature_narration')->textarea(['rows' => 6]) ?>

    <?php // echo $form->field($model, 'feature_video_url')->textarea(['rows' => 6]) ?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>
      <?= $form->field($model, 'fk_property_id')->hiddenInput()->label("") ?>

    <div class="form-group">
        <?php 
          if($model->isNewRecord){
             $url =  Url::to(["$view_name/create",'fk_property_id'=>$model->fk_property_id]);
          }
          else{
              $url =  Url::to(["$view_name/update",'id'=>$model->id]);
          }
        ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
