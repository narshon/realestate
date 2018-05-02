<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\Term;
use app\models\AccountChart;

/* @var $this yii\web\View */
/* @var $model app\models\AccountMap */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
        use yii\helpers\Url;
        $view_name = 'account-map';
        $id = isset($model->id)?$model->id:0;
        echo <<<EOD
        <div class="$view_name-form" id="$view_name-form-div-$id">
              <div id="$view_name-form-alert-$id"></div>
EOD;
        $form = ActiveForm::begin(['id'=>"$view_name-form-$id"]);
?>

    <?= $form->field($model, 'fk_term')->widget(Select2::classname(), [
            'data' => Term::getTermOptions(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_terms'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ]);  ?>

    <?= $form->field($model, 'fk_account_chart')->widget(Select2::classname(), [
            'data' => AccountChart::getAccountsOptions(),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_account_chart'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ]); ?>  

    <?= $form->field($model, 'transaction_type')->dropDownList([ 'credit' => 'Credit', 'debit' => 'Debit', ], ['prompt' => '']) ?>

    <?=   $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => \app\models\Lookup::getLookupValues('Status'),
            'options' => ['placeholder' => 'Please Select ...', 'id'=>'select2_status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ]);  ?>



    <div class="form-group">
        <?php $url =  Url::to([$model->isNewRecord ? "$view_name/create" : "$view_name/update",'id'=>$model->id]);  ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>'btn btn-danger btn-create','onclick'=>"ajaxFormSubmit('$url','$view_name-form-div-$id','$view_name-form-$id',1); return false;"]) ?>
    </div><div style="clear:both"></div>

    <?php ActiveForm::end(); ?>

</div>
