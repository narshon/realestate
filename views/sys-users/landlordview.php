<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OccupancyIssueSearch;
use app\utilities\DataHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\SysUsers */

$this->title = 'Landlord: '.$model->getNames();

$this->registerCss("
            .container{
                width:98% !important;
            }
            .leftbar{
               background: #B5121B;
               color:#ffffff !important;
               padding-top:10px;
            }
            .leftbar a{
                color:#ffffff !important;
            }
            .leftbar a:hover, a:active{
                color:#000000 !important;;
                /* background-color: #000000 !important; */
            }
            
            .rightbar{
                
            }
        "); 

?>
<div class="panel panel-danger">
      <div class="panel-heading">
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
	  <div class="leftbar col-md-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#landlord" role="tab">Landlord Details</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tenant" role="tab">Properties & Tenants</a></li>
				<!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#issue" role="tab">Issues</a></li>  -->
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#imprest" role="tab">Imprest</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#disbursement" role="tab">Disbursement</a></li>
				
				
			</ul> 
			</div>
		<div class="rightbar col-md-10">
			<div class="tab-content">
				<div class="tab-pane active" id="landlord" role="tabpanel">
                                    <div class="sys-users-view">

    <p>
        <?php 
            $dh = new DataHelper();
            $url = Url::to(['landlordform','id'=>$model->id]);
            echo $dh->getModalButton($model, "sys-users/landlordform", "Users", 'glyphicon glyphicon-edit pull-right','',$url,'Users');
         ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
               'label' => 'Names',
                'format'=>'raw',
                'value' => $model->getNames(),
            ],
            
            'email:email',
            'phone',
            'address:ntext',
            'date_added',
            'gender',
            'residence',
           
        ],
    ]) ?>

</div>
</div>
        <div class="tab-pane" id="tenant" role="tabpanel">
          <?php
            //show properties of this landlord.
            $searchModel = new \app\models\PropertySearch();
            $dataProvider = new ActiveDataProvider(['query' => \app\models\Property::find()->where(['owner_id'=> $model->id,'management_id'=>Yii::$app->user->identity->fk_management_id]),]);
             echo Yii::$app->controller->renderPartial("../property/property", [
                  'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
                  'landlord'=>$model
              ]); ?>
        </div>
	<!--  <div class="tab-pane " id="issue" role="tabpanel">
	  <?php
           /*  $searchModel = new OccupancyIssueSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-issue/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]); */	  ?>
	  </div>  -->
	  <div class="tab-pane " id="imprest" role="tabpanel"></div>
	  <div class="tab-pane " id="disbursement" role="tabpanel"></div>
	  </div>
	  </div>
</div>
</div>