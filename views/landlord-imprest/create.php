<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LandlordImprest */

$this->title = 'Create Landlord Imprest';
$this->params['breadcrumbs'][] = ['label' => 'Landlord Imprests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="landlord-imprest-create">


    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
