<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\accounts */

$this->title = 'Update Accounts: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accounts-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
