<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\source */

$this->title = 'Update Source: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="source-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
