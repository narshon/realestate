<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Term */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="term-view">

    <h1><?= Html::encode($this->title) ?></h1>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
           // 'term_type',
            'term_name',
            'term_desc:ntext',
            //'_status',
            //'date_created',
            //'created_by',
            //'date_modified',
           //'modified_by',
        ],
    ]) ?>

</div>
