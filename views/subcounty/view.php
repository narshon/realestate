<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subcounty */

$this->title = $model->subcounty_name;
$this->params['breadcrumbs'][] = ['label' => 'Subcounties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcounty-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'=>'County',
                'format'=>'raw',
                'value'=>$model->fkCounty->county_name,
            ],
            'subcounty_name',
            'subcounty_desc:ntext',
        ],
    ]) ?>

</div>
