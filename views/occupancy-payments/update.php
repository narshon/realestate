<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */

$this->title = 'Update Occupancy Payments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Occupancy Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="occupancy-payments-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
