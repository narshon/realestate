<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountType */

$this->title = 'Update Account Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Account Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-type-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
