<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyFeatureImage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Property Feature Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-feature-image-view">

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
            'fk_property_feature_id',
            'image_url:ntext',
            'image_title',
            'image_caption:ntext',
            '_status',
            'date_created',
            'created_by',
            'date_modified',
            'modified_by',
        ],
    ]) ?>

</div>