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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fk_account_chart',
            'trasaction_type',
            'amount',
            'entry_date',
            //'created_on',
            //'created_by',
        ],
    ]) ?>

</div>
