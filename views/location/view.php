<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <h1><?= Html::encode($this->title) ?></h1>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            
            [
                            'label' => 'Ward',
                             'format'=>'raw',
                             'value' =>$model->fkWard->ward_name,
                         ],
            
            'location_name',
            'location_desc:ntext',
        ],
    ]) ?>

</div>
