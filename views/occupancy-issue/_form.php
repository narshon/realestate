<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyIssue */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        use yii\helpers\Url;
        $view_name = 'occupancy-issue';
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

    <?= $form->field($model, 'fk_related_term')->dropdownList(
         app\models\OccupancyTerm::getOccupancyTermOptions(),
        ['prompt'=>'Please Select']
    ); ?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, 'issue_type')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Issue Type'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_issue_type'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>

    <?= $form->field($model, 'status_remarks')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
