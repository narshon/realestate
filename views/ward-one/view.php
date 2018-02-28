<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WardOne */

$this->title = $model->ward_name;
$this->params['breadcrumbs'][] = ['label' => 'Ward Ones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ward-one-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
            'label' => 'Sub County',
             'format'=>'raw',
             'value' =>$model->fkSubcounty->subcounty_name,
            ],
            'ward_name',
            'ward_desc:ntext',
            'ward_lat',
            'ward_long',
        ],
    ]) ?>

</div>
