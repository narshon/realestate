<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Feature */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Features', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="feature-view">

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'feature_name',
            'feature_desc:ntext',
           /* 'created_by',
            'date_created',
            'modified_by',
            'date_modified', */
        ],
    ]) ?>

</div>
