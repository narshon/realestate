<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use app\utilities\DataHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DisbursementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><?= "Disbursements"; ?></a></li>
            <li class=""><a data-toggle="tab" href="#imprest"><?= "Imprests"; ?></a></li>
           
        </ul>
        <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
<div class="disbursements-index">

            <p> <br/>
                <?php 
                      $dh = new DataHelper();
                     // $url = Url::to(['disbursements/pay','owner_id'=>$landlordModel->id]);
                    //   echo $dh->getModalButton(new \app\models\Disbursements(), "disbursements/pay", 'Payments', 'btn btn-danger btn-create pull-right', 'Make Payments',$url);
                      echo  Html::button('<i class="glyphicon glyphicon-ban-circle">  Pay </i>', [
                            'type'=>'button', 
                            'title'=>'Adding Imprest Items', 
                            'class'=>'btn bg-purple btn-flat showModalButton specmargin pull-right', 
                            'value' => yii\helpers\Url::to(['disbursements/pay', 'owner_id'=>$landlordModel->id])]);
                ?>
            </p> <br/>

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
<?php Pjax::end(); ?></div>
</div>

      <div id="imprest" class="tab-pane fade">
        <?php
           $searchModel = new \app\models\LandlordImprestSearch();
           $dataProvider = new ActiveDataProvider(['query' => \app\models\LandlordImprest::find()->where(['fk_landlord'=>$landlordModel->id])->orderBy("id DESC")]);
             echo Yii::$app->controller->renderPartial("../landlord-imprest/index", [
                  'dataProvider' => $dataProvider, 'searchModel' => $searchModel
              ]); 
        ?>
      </div>     

    </div>
        
    </div>
</div>
