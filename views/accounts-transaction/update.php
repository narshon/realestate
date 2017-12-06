<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountsTransaction */

$this->title = 'Update Accounts Transaction: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accounts Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accounts-transaction-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
