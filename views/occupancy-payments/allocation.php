<?php
use kartik\sortinput\SortableInput;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

 $this->registerJs('processStatus();');
// $this->registerJs("mapStatus();")
?>

<div class="section">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'payments_pool')->textInput(['disabled' => true]) ?>
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
            Occupancy Details and Links
            <?= SortableInput::widget([
                'name'=>'bills_pool',
                'items' => $bills,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>true,
                    'pluginEvents' =>[
                        'sortupdate' => 'function(e, ui){processEvents(e, ui)}'
                    ]
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true, 'id' => 'bills_sortable']
            ]); ?>
        </div>
        <div class="col-md-5">
            Payments - Bills Mapping
            <?= SortableInput::widget([
                'name'=>'cleared_bills',
                'items' => $model->sorted,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>true,
                    'pluginEvents' =>[
                        'sortupdate' => 'function(e, ui){processEvents(e, ui)}'
                    ]
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true, 'id' => 'sorted_bills']
            ]); ?>
        </div>
        <div class="col-md-1"></div>
    </div>
    
    
    <div class="form-group" style="padding-top:15px;">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center">
            <?= Html::hiddenInput('url', \yii\helpers\Url::toRoute(['occupancy-payments/get-bill-amount']), ['id' =>'url_'])?>
            <?= Html::submitButton('Map', ['class' => 'btn btn-primary', "onclick"=>"return mapStatus(); // return false; "]) ?>
        </div>
        <div class="col-md-4"></div>
        
    </div>

    <?php ActiveForm::end(); ?>
</div>