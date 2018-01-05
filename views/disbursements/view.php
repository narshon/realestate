<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Disbursements */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursements-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fk_occupancy_rent',
            'fk_landlord',
            'batch_id',
            'amount',
            'entry_date',
            'created_on',
            'created_by',
            '_status',
        ],
    ]) ?>

</div>
