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

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
