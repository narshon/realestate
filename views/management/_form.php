<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Management */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'management';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
    
    <?= $form->field($model, 'fk_user_id')->dropdownList(
         app\models\SysUsers::find()->select(['username', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Select group']
    ); ?> 
    
     <?= $form->field($model, 'management_name')->textInput() ?>
    
    <?= $form->field($model, 'management_type')->dropdownList(
         app\models\Lookup::getLookupValues('management type'),
        ['prompt'=>'Select group']
    ); ?>


    <?= $form->field($model, 'location')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'profile_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'featured_property')->dropdownList(
         app\models\Property::find()->select(['property_name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Select group']
    ); ?> 

    <?= $form->field($model, '_status')->dropdownList(
         app\models\Lookup::getLookupValues('status'),
        ['prompt'=>'Select group']
    ); ?>

   <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
