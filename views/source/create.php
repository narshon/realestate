<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\source */

$this->title = 'Create Source';
$this->params['breadcrumbs'][] = ['label' => 'Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
