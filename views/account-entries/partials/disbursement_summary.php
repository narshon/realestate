<?php
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<h3>Disbursement Summary for: <?= date('d-m-Y')  ?></h3>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
              'label'=> "Property",
              'attribute' => 'property',
              'format' => 'raw',
              'value' => function ($data) {
                  return $data->fkOccupancyRent->fkOccupancy->fkProperty->property_name;
               },
             ],
            [
              'label'=> "Tenant",
              'attribute' => 'fk_occupancy_rent',
              'format' => 'raw',
              'value' => function ($data) {
                  return $data->fkOccupancyRent->fkOccupancy->getTenantName();
               },
             ],
             [
              'label'=> "Period",
              'attribute' => 'month',
              'format' => 'raw',
              'value' => function ($data) {
                  return $data->month."/".$data->year;
               },
             ],
            [
              'label'=> "Landlord",
              'attribute' => 'landlord',
              'format' => 'raw',
              'value' => function ($data) {
                  return $data->fkOccupancyRent->fkOccupancy->fkProperty->owner->getNames();
               },
             ],
            //'batch_id',
            'amount',
            // 'entry_date',
            // 'created_on',
            // 'created_by',
             [
              'label'=> "Status",
              'attribute' => '_status',
              'format' => 'raw',
              'value' => function ($data) {
                    return app\models\Lookup::getLookupCategoryValue(app\models\LookupCategory::getLookupCategoryID("Disbursement Status"), $data->_status);
               },
             ],

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>