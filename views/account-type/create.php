<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountType */

$this->title = 'Create Account Type';
$this->params['breadcrumbs'][] = ['label' => 'Account Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
