<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LookupCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-category-view">

   

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_name',
        ],
    ]) ?>

</div>
