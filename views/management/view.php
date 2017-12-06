<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Management */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="management-view">

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
            'fk_user_id',
            'management_name',
            'management_type',
            'location:ntext',
            'address:ntext',
            'profile_desc:ntext',
            'featured_property',
            'date_created',
            'created_by',
            'date_modified',
            'modified_by',
            '_status',
        ],
    ]) ?>

</div>
