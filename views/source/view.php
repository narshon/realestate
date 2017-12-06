<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\source */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'source_name',
            'source_description:ntext',
            'source_type',
        ],
    ]) ?>

</div>
