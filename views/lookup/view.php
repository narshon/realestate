<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lookup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lookups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-view">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            '_key',
            '_value:ntext',
            'category',
            '_order',
            '_status',
            'created_by',
            'date_created',
            'modified_by',
            'date_modified',
        ],
    ]) ?>

</div>
