<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccountChart */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Account Charts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-chart-view">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'name',
            
			 [
                'label'=>'Account Type',
                'value'=>$model->fkReAccountType->term_name,
            ],
            
			[                      // the owner name of the model
             'label' => 'Status',
             'value' => app\models\Lookup::getLookupCategoryValue(\app\models\LookupCategory::getLookupCategoryID('Status'), $model->status),
            ],
            'description:ntext',
            //'created_by',
           // 'modified_by',
            //'created_on',
           // 'modified_on',
        ],
    ]) ?>

</div>
