<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyFeatureImage */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'property-feature-image';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

    <?php echo $form->field($model, 'fk_property_feature_id')->hiddenInput() ?> 
    <?php echo $form->field($model, 'img_temp_url')->hiddenInput() ?>

    <?= $form->field($model, 'image_url')->fileInput() ?>
    <?php $upload_url =  Url::to(['site/upload']); ?>
    <?= Html::submitButton("Upload File", ['class' =>'btn btn-danger btn-create','onclick'=>" uploadFile('$upload_url','upload_div', 'propertyfeatureimage-image_url'); return false;"]); ?>

    <div id="upload_div">
    </div>

    <?= $form->field($model, 'image_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_caption')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, '_status')->textInput() ?>

    <div class="form-group">
        <?php  $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);
              
        ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>" ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1);  return false;"]);  ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
