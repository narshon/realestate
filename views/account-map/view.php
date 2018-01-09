<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccountMap */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Account Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-map-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fk_term',
            'fk_account_chart',
            'transaction_type',
            'status',
            //'created_on',
            //'created_by',
            //'modified_on',
           // 'modified_by',
        ],
    ]) ?>

</div>
