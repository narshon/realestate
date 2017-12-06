<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PropertySublet */

?>
<div class="property-sublet-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
           [
               'label'=>'Property',
               'value'=>$model->fkProperty->property_name,
            ],
            'sublet_name',
            'sublet_desc:ntext',
            [                      // the owner name of the model
             'label' => 'Status',
             'value' => app\models\Lookup::getLookupCategoryValue(\app\models\LookupCategory::getLookupCategoryID('Status'), $model->_status),
            ],
            
        ],
    ]) ?>

</div>
