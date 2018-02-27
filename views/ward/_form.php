<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
 use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Ward */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
       
        $view_name = 'ward';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

   <pre> <?php  print_r($model); ?> </pre>
    

    <?php ActiveForm::end(); ?>

</div>
