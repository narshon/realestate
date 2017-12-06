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

   
    <?php echo "<strong> Property: ".$model->getOccupancyName()."</strong><br/>"; ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <?= $form->field($model, 'month')->dropdownList(
         app\utilities\DataHelper::getMonthOptions(),
        ['prompt'=>'Please Select']
    ); ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <?= $form->field($model, 'year')->dropdownList(
         app\utilities\DataHelper::getYearOptions(),
        ['prompt'=>'Please Select']
    ); ?>
    </div>
    
</div>
    <?= $form->field($model, 'fk_source')->dropdownList(
         app\models\Source::getTenantOptions(),
        ['prompt'=>'Please Select']
    ); ?>

     <?= $form->field($model, 'amount')->textInput() ?>

    <?php  // Usage with ActiveForm and model
        echo $form->field($model, '_status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);  ?>


    <div class="form-group">
        <?php 
        if($model->isNewRecord){
            $url =  Url::to(["$view_name/create",'occupancy_id'=>$model->id]);  
        }
        else{
            $url =  Url::to(["$view_name/update",'id'=>$model->id]);  
        }
        
        
        ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>
    <?= $form->field($model, 'fk_occupancy_id')->hiddenInput()->label("") ?>
    <?php ActiveForm::end(); ?>

</div>
