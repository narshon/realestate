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
           // 'id',
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
            [                      // the owner name of the model
             'label' => 'Current Tenant',
             'format' => 'raw',
             'value' => $model->getOccupant(),
            ],
            
        ],
    ]) ?>
  <?php
    $prevTenants = $model->getPreviousTenants()
   ?>
  <?php if($prevTenants): ?>
  <table id="t01">
  <tr>
      <td colspan="4"> <h3>Previous Tenants </h3></td>
    
  </tr>
  <tr>
    <th>Tenant Name</th>
    <th>Date Started</th> 
    <th>Date Shifted</th> 
    <th>Status</th>
  </tr>
   <?php
   foreach($prevTenants as $tenant) :
   ?>
   <tr>
    <td><?= $tenant->getTenantViewLink() ?></td>
    <td><?= $tenant->start_date ?></td> 
    <td><?= $tenant->end_date ?></td> 
    <td><?= $tenant->getStatus() ?></td>
  </tr>
  <?php endforeach ?>
  </table>
  <?php endif ?>
</div>
