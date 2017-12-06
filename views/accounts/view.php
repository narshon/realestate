<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\accounts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-view">

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'account_name',
            'account_description:ntext',
            'account_no',
            'bank_name',
            'branch',
            'bank_code',
            //'date_created',
            //'created_by',
            //'date_modified',
            //'modified_by',
        ],
    ]) ?>

</div>
