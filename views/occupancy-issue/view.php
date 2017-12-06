<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyIssue */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Occupancy Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-issue-view">

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
            'fk_occupancy_id',
            'fk_related_term',
            'issue_type',
            'title',
            'desc:ntext',
            '_status',
            'status_remarks:ntext',
            'date_created',
            'created_by',
            'date_modified',
            'modified_by',
        ],
    ]) ?>

</div>
