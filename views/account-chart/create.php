<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountChart */

$this->title = 'Create Account Chart';
$this->params['breadcrumbs'][] = ['label' => 'Account Charts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-chart-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
