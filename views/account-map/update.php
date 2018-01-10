<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountMap */

$this->title = 'Update Account Map: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Account Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-map-update">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
