<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdvertFeature */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'advert-feature';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

    <?= $form->field($model, 'fk_advert_id')->textInput() ?>

    <?= $form->field($model, 'fk_feature_id')->textInput() ?>

    <?= $form->field($model, 'feature_narration')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, '_status')->textInput() ?>


   <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
