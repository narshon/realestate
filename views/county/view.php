<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\County */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Counties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="county-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'county_name',
            'county_desc:ntext',
        ],
    ]) ?>

</div>
