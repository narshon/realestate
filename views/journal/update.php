<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

$this->title = 'Update Journal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="journal-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
