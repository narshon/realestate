<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyArea */

$this->title = $model->id;

?>
<div class="property-area-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'=>'Property',
                'value'=>$model->property->property_name,
            ],
            [
                'label'=>'Sub Location',
                'value'=>$model->subLocation->sub_loc_name,
            ],
            [
                'label'=>'Estate',
                'value'=>$model->estate->estate_name,
            ],
            'area_desc:ntext',
            [                      // the owner name of the model
             'label' => 'Status',
             'value' => app\models\Lookup::getLookupCategoryValue(\app\models\LookupCategory::getLookupCategoryID('Status'), $model->_status),
            ],
        ],
    ]) ?>

</div>
