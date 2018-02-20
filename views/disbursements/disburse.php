<?php
use kartik\sortinput\SortableInput;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

$this->registerJs('processDStatus();')
?>

<div class="section">
   <?php 
        use yii\helpers\Url;
        $view_name = 'disbursements';
        $id = isset($model->id)?$model->id:0;
?>
        <div class="<?= $view_name ?>-form " id="<?= $view_name ?>-form-div-<?= $id ?>">
              <div id="<?= $view_name ?>-form-alert-<?= $id ?>"></div>

   <?php   $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'payments_pool')->textInput(['disabled' => true,'value'=>0]) ?>
            </div>
            <div class="col-md-4">
                <div class="processing" style='display:none;text-align:left; margin-top: 30px !important;'>  <?=Html::img('@web/images/radio.gif')?></div>
            </div>
            
        </div>
        <div class="col-md-12">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4 payment-calculator">
                
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class ="col-md-5">
            Non-Payable Disbursements
            <?= SortableInput::widget([
                'name'=>'bills_pool',
                'items' => [],
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>true,
                    'pluginEvents' =>[
                        'sortupdate' => 'function(e, ui){processDEvents(e, ui)}'
                    ]
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true, 'id' => 'bills_sortable']
            ]); ?>
        </div>
        <div class="col-md-5">
            Payable Disbursements 
            <?= SortableInput::widget([
                'name'=>'cleared_bills',
                'items' => $bills,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>true,
                    'pluginEvents' =>[
                        'sortupdate' => 'function(e, ui){processDEvents(e, ui)}'
                    ]
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true, 'id' => 'sorted_bills']
            ]); ?>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <strong> Advances Paid (Will deduct from payment pool) </strong>
            <?= $form->field($model, 'payments_advance')->textInput(['disabled' => true])->label("") ?>
            <?= $form->field($model, 'payments_advance_ids')->hiddenInput(['disabled' => true])->label("") ?>
        </div>
        
         <div class="col-md-1"></div>
    </div>
    
    <div class="form-group" style="padding-top:15px;">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center">
            <?= Html::hiddenInput('url', \yii\helpers\Url::toRoute(['disbursements/get-bill-amount']), ['id' =>'url_'])?>
            <?php // Html::submitButton('Submit Disbursements', ['class' => 'btn btn-primary','id'=>'map-btn']) ?>
            <?php $url =  Url::to([ "$view_name/pay",'owner_id'=>$owner_id]);  ?>
        <?= Html::submitButton("Submit Disbursements", ['class' =>'btn btn-primary','id'=>'map-btn', 'onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>