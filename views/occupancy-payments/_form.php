<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */
/* @var $form yii\widgets\ActiveForm */

?>

    <?php 
        $view_name = 'occupancy-payments';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id" style="text-align: center">
              
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
    <div id="<?= $view_name."-form-alert-".$id ?>">  </div>
    
    <div class="row header" style="border-bottom: 1px #505039 solid; padding-bottom: 30px;">  
        <div class="col-md-4">
            <label>Tenant:</label>
            <?= \app\models\Occupancy::getDetail($model->fk_occupancy_id, 'name')?>
        </div>
        <div class="col-md-4">
            <label>Property:</label>
            <?= \app\models\Occupancy::getDetail($model->fk_occupancy_id, 'property')?>
        </div>
        <div class="col-md-4">
            <label>Sublet:</label>
            <?= \app\models\Occupancy::getDetail($model->fk_occupancy_id, 'sublet')?>
        </div>
        
        <div class="row col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?= $form->field($model, 'account')->dropdownList(
                 \app\models\AccountChart::getFundAccounts(),
                        ['prompt'=>'--select--']
                    )->label("Select Account"); ?>
            </div>
            <div class="col-md-4"></div>
       </div>
        
        <div class="row col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'mode')->dropdownList(
             \app\models\Lookup::getLookupValues('Payment Mode'),
                    ['prompt'=>'--select--']
                ); ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>
    <div class="row col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'payment_method')->dropdownList(
             \app\models\Lookup::getLookupValues('Payment Method'),
                    ['prompt'=>'--select--']
                ); ?>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>
    <div class="row col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= $form->field($model, 'ref_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>
    <div class="form-group">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?php // echo Html::submitButton('Receive', ['class' => 'btn btn-danger showModalButton']) ?>
            <div class="form-group">
                <?php 
                    $url =  Url::to(["$view_name/create",'id'=>$occupancy_id]);  
                 ?>
                <?= Html::submitButton('Make Payment', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
           </div>
        </div>
        <div class="col-md-4"></div>
        
    </div>
        
    </div> 

    <?php ActiveForm::end(); ?>
</div>

