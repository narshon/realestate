<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountMap */

$this->title = 'Create Account Map';
$this->params['breadcrumbs'][] = ['label' => 'Account Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-map-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
