<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyTerm */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Property Terms', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-term-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
               'label'=>'Property',
               'value'=>$model->fkProperty->property_name,
            ],
            [
               'label'=>'Term',
               'value'=>$model->fkTerm->term_name,
            ],
            'term_title',
            'term_narration:ntext',
            'action_handler',
           [                      // the owner name of the model
             'label' => 'Status',
             'value' => app\models\Lookup::getLookupCategoryValue(\app\models\LookupCategory::getLookupCategoryID('Status'), $model->_status),
            ],
        ],
    ]) ?>

</div>
