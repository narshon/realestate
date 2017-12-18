<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */

$this->title = 'Create Occupancy Payments';
$this->params['breadcrumbs'][] = ['label' => 'Occupancy Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-payments-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
