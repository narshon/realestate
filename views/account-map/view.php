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
         
			[
                            'label' => 'Term',
                             'format'=>'raw',
                             'value' =>$model->fkTerm->term_name,
              ],
            
			[
                            'label' => 'Account Chart',
                             'format'=>'raw',
                             'value' =>$model->fkAccountChart->name,
              ],
            'transaction_type',
            
			[                      // the owner name of the model
             'label' => 'Status',
             'value' => app\models\Lookup::getLookupCategoryValue(\app\models\LookupCategory::getLookupCategoryID('Status'), $model->status),
            ],
            //'created_on',
            //'created_by',
            //'modified_on',
           // 'modified_by',
        ],
    ]) ?>

</div>
