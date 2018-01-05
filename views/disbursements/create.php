<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Disbursements */

$this->title = 'Create Disbursements';
$this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
