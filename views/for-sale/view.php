<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-view">

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
            'advert_name',
            'advert_desc:ntext',
            'advert_owner_id',
            'start_date',
            'end_date',
            '_status',
            'advert_fee',
            'image1:ntext',
            'image2:ntext',
            'image3:ntext',
            'image4:ntext',
            'image5:ntext',
            'contact_details:ntext',
            'date_created',
            'created_by',
            'date_modified',
            'modified_by',
        ],
    ]) ?>

</div>
