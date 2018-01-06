<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccountEntries */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Account Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-entries-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fk_account_chart',
            'trasaction_type',
            'amount',
            'entry_date',
            'created_on',
            'created_by',
        ],
    ]) ?>

</div>
