<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
<div class="site-login" id="login-form-div">

    
    <div id="login-form-alert"><strong>Please sign in or register to continue.</strong></div><br/>
    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?php
$url = Url::to(["site/loginform"]);
?>
        <?= Html::submitButton('&nbsp; &nbsp;&nbsp; Login &nbsp; &nbsp;&nbsp;', ['class' =>'btn btn-info','onclick'=>"ajaxFormSubmit('$url','login-form-div','login-form',1,1); return false;"]) ?><br/>
                <?php
                $uri = Url::to(['sys-users/register']);
                $register = Html::a("Register", ['#'], ['class' => 'btn btn-success btn-sm',  'onclick'=>"ajaxUniversalGetRequest('$uri','login-form-div','', 1); return false;"]);
                
                ?> <br/>
                <strong>New member? Please </strong> <?= $register ?> here.
                <?php
                $forgoturi = Url::to(['sys-users/forgotpass']);
                $forgot = Html::a("Forgot Password?", ['#'], ['class' => 'btn btn-warning btn-sm',  'onclick'=>"ajaxUniversalGetRequest('$forgoturi','login-form-div','', 1); return false;"]);
                
                ?> <br/>
                 <?= $forgot ?>
            </div>
        </div>
    
        

    <?php ActiveForm::end(); ?>

</div>
