<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OccupancyTerm */

$this->title = $model->fkPropertyTerm->fkTerm->term_name;
$this->params['breadcrumbs'][] = ['label' => 'Occupancy Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-term-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fk_occupancy_id',
            'fk_property_term_id',
            'date_signed',
            '_status',
           
        ],
    ]) ?>

</div>
