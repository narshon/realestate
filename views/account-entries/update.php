<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountEntries */

$this->title = 'Update Account Entries: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Account Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-entries-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
