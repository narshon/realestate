<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Journal */

$this->title = 'Create Journal';
$this->params['breadcrumbs'][] = ['label' => 'Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
