<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Journal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'receipt_invoice_no',
            'cheque_no',
	    'account_type',
	     'transaction_type',
            'details:ntext',
            'transacted_by',
            //'date_created',
            //'created_by',
            //'date_modified',
            //'modified_by',
        ],
    ]) ?>

</div>
