<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Journal;
use app\models\Accounts;
use app\models\Source;

/* @var $this yii\web\View */
/* @var $model app\models\AccountsTransaction */
/* @var $form yii\widgets\ActiveForm */
$view_name = 'accounts-transaction';
$id = isset($model->id)?$model->id:0;
echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
?>

    <?php $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]); ?>
	
<?php echo  $form->field($model, 'reconciled')->dropdownList([0=>'Not Valid',1=>'Validate',2=>'Override & Validate'],['prompt'=>'Please Select'])->label("Validate Transaction");  ?> 
   
<?php echo $form->field($model, 'reconciled_amount')->textInput(['maxlength' => true])->label("Override Amount"); ?> 


    <div class="form-group">
        <?php
$url = Url::to(["$view_name/reconcile",'id'=>$model->id]);
?>
        <?= Html::submitButton("Validate", ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>


<script type="text/javascript">
    
    reconcile();
    $('#accountstransaction-reconciled').change(function(){
       reconcile()
    });
    
    function reconcile(){
        var reconciled =  $('#accountstransaction-reconciled').val();
      if(reconciled == 2){
          $('.field-accountstransaction-reconciled_amount').show(); 
      }
      else{
          $('.field-accountstransaction-reconciled_amount').hide();
          $('#accountstransaction-reconciled_amount').val('');
      }  
    }
       
  
</script>