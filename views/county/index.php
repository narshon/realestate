<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\County;
use app\models\Subcounty;
use app\models\Ward;
use app\models\Location;
use app\models\SubLocation;
use app\utilities\DataHelper;
use app\models\Estate;
use yii\widgets\Pjax;
use app\models\SubcountySearch;
use app\models\WardOneSearch;
use app\models\LocationSearch;
use app\models\SubLocationSearch;
use app\models\EstateSearch;
use app\models\Management;
use app\models\SysUsersSearch;
use app\models\Users;
use app\models\Feature;
use app\models\TermSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->user->identity->fkManagement->management_name;
$this->params['breadcrumbs'][] = $this->title;

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
        
        <h2><?= $this->title; ?></h2>
        
    </div>
	 <div class="panel-body">
	  <div class="leftbar col-md-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#agency" role="tab">Agency profile</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#roles" role="tab">Agent Users</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#terms" role="tab">Terms</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#location" role="tab">Location</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#lookup" role="tab">Lookup</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#features" role="tab">Features</a></li>
			
				
				
			</ul> 
			</div>
	<div class="rightbar col-md-10">
	<div class="tab-content">
	<div class="tab-pane" id="location" role="tabpanel">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#county">Counties</a></li>
            <li><a data-toggle="tab" href="#subcounty">Subcounties </a></li>
            <li><a data-toggle="tab" href="#wards">Wards</a></li>
            <li><a data-toggle="tab" href="#location">Locations</a></li>
            <li><a data-toggle="tab" href="#sublocation">Sub-locations</a></li>
            <li><a data-toggle="tab" href="#estate">Estates</a></li>
        </ul>
		
        <div class="tab-content">

      <div id="county" class="tab-pane fade in active">
        <div class="county-index">
            <p>
                <?php 
					$dh = new DataHelper();
					  $url=Url::to(['county/create']);
                       echo $dh->getModalButton(new County, 'county/create', 'County', 'btn btn-danger btn-create',"New",$url,"County");
                    ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-county',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
              //  'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'county_name',
                    'county_desc:ntext',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
									'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['county/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "county/view", "County", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
									},
											  
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['county/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "county/update", "County", 'glyphicon glyphicon-edit','',$url);
                                            },
                            ], 
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
      </div>

      <div id="subcounty" class="tab-pane fade">
        <?php
             $searchModel = new SubcountySearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../subcounty/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="wards" class="tab-pane fade">
        <?php
             $searchModel = new WardOneSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../ward-one/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="location" class="tab-pane fade">
        <?php
             $searchModel = new LocationSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../location/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>

      <div id="sublocation" class="tab-pane fade">
        <?php
             $searchModel = new SubLocationSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../sub-location/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>
            
       <div id="estate" class="tab-pane fade">
        <?php 
             $searchModel = new EstateSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../estate/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
      </div>
	  </div>
	</div>
	</div>
    
	<div class="tab-pane active" id="agency" role="tabpanel">
	<?php
	 //get agent record
	 
	 $agent = Management::find()->where(['id'=>Yii::$app->user->identity->fk_management_id])->one();
	if($agent){ 
	 echo $this->render('../management/agentview',['model'=>$agent]);
 }
	 ?>
	</div>
	<div class="tab-pane" id="roles" role="tabpanel">
	<?php 
	   $searchModel = new SysUsersSearch();
        $dataProvider = new ActiveDataProvider(['query' => Users::find()->where(['fk_group_id'=> \app\models\Group::getAgentusersID(),'fk_management_id'=>Yii::$app->user->identity->fk_management_id]),]);
       echo $this->render('/sys-users/agentusers', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
	?></div>
            <div class="tab-pane" id="terms" role="tabpanel">
                <?php
                  $searchModel = new TermSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../term/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
            </div>
            
             <div class="tab-pane" id="lookup" role="tabpanel">
                <?php
                  $searchModel = new app\models\LookupCategorySearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../lookup-category/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
            </div>
            
             <div class="tab-pane" id="features" role="tabpanel">
                <?php
                  $searchModel = new app\models\FeatureSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../feature/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
            </div>
		
	</div>
	</div>
	
	
	</div>
</div>
 