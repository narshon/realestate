<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountsTransaction */

$this->title = 'Create Accounts Transaction';
$this->params['breadcrumbs'][] = ['label' => 'Accounts Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-transaction-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
