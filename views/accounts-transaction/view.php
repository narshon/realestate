<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccountsTransaction */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accounts Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-transaction-view">

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fk_journal',
            'fk_account',
            'fk_source',
            'dr',
            'cr',
            'running_balance',
            'details:ntext',
            //'date_created',
            //'created_by',
            //'date_modified',
            //'modified_by',
        ],
    ]) ?>

</div>
