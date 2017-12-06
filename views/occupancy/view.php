<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Occupancy */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Occupancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-view">

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
            'fk_property_id',
            'fk_sublet_id',
            'fk_tenant_id',
            'start_date',
            'end_date',
            'notes:ntext',
            '_status',
            'date_created',
            'created_by',
            'date_modified',
            'modified_by',
        ],
    ]) ?>

</div>
