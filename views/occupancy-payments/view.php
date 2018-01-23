<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Occupancy Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-payments-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fk_occupancy_id',
            'amount',
            'payment_date',
            'fk_receipt_id',
            'payment_method',
            'ref_no',
            'status',
            'created_by',
            'created_on',
            'modified_by',
            'modified_on',
        ],
    ]) ?>

</div>
