<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'for-sale';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

    <?= $form->field($model, 'advert_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'advert_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'advert_owner_id')->dropdownList(
         app\models\SysUsers::find()->select(['username', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Please Select']
    ); ?>

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

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>

    <?= $form->field($model, 'advert_fee')->textInput() ?>

    <?= $form->field($model, 'image1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image4')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image5')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_details')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id], true);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
