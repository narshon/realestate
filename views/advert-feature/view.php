<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AdvertFeature */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Advert Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-feature-view">

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
            'fk_advert_id',
            'fk_feature_id',
            'feature_narration:ntext',
            'image1:ntext',
            'image2:ntext',
            'image3:ntext',
            '_status',
            'date_created',
            'created_by',
            'date_modified',
            'modified_by',
        ],
    ]) ?>

</div>
