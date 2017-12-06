<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SubLocation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-location-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
           
             [
                            'label' => 'Location',
                             'format'=>'raw',
                             'value' =>$model->fkLocation->location_name,
                         ],
            'sub_loc_name',
            'sub_loc_desc:ntext',
        ],
    ]) ?>

</div>
