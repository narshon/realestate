<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccountType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Account Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'Description',
            //'created_by',
            //'modified_by',
            //'created_on',
            //'modified_on',
        ],
    ]) ?>

</div>
