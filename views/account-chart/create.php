<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountChart */

$this->title = 'Create Account Chart';
$this->params['breadcrumbs'][] = ['label' => 'Account Charts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-chart-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
