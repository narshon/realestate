<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LandlordImprest */

$this->title = 'Update Landlord Imprest: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Landlord Imprests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="landlord-imprest-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
