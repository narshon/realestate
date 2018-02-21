<?php
use yii\grid\GridView;
use yii\widgets\Pjax;

?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
           // 'fk_landlord',
            //'batch_id',
            'amount',
             'entry_date',
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