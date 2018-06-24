<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyRent */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php 
        $view_name = 'occupancy-rent';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id" style="text-align: center">
              
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
    <div id="<?= $view_name."-form-alert-".$id ?>">  
    <?php  
      if($model->hasErrors()){
          echo "Errors";
          foreach($model->getErrors() as $error){
              echo print_r($error, true)."<br/>";
          }
          
      }
    ?>
   </div>
        <div class="header" >
            <div class="col-md-4">
                <label>Property Name:</label>
                <?=$model->fkOccupancy->fkProperty->property_name ?>
            </div>
            <div class="col-md-4">
                <label>Property Unit:</label>
                <?=$model->fkOccupancy->fkSublet->sublet_name ?>
            </div>
            <div class="col-md-4">
                <label>Occupant:</label>
                <?=$model->fkOccupancy->fkTenant->getNames()?>
            </div>
         </div> 
            <?= $form->field($model, 'month')->dropdownList(
             app\utilities\DataHelper::getMonthOptions(),
            ['prompt'=>'Please Select']
        ); ?>
        
            <?= $form->field($model, 'year')->dropdownList(
             app\utilities\DataHelper::getYearOptions(),
            ['prompt'=>'Please Select']
        ); ?>
       
            <?= $form->field($model, 'fk_term')->dropdownList(
 app\models\OccupancyTerm::getTermList($model->fk_occupancy_id),
            ['prompt'=>'Please Select']
        ); ?>
        
            <?= $form->field($model, 'amount')->textInput() ?>
        
     
       
            <?php // echo Html::submitButton('Receive', ['class' => 'btn btn-danger showModalButton']) ?>
            <div class="form-group">
                <?php 
                    $url =  Url::to(["$view_name/create",'occupancy_id'=>$occupancy_id]);  
                 ?>
                <?= Html::submitButton('Add Bill', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
           </div> <br/><br/>

    <?php ActiveForm::end(); ?>
</div>