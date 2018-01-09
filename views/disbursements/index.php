<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DisbursementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disbursements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursements-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
             '_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
