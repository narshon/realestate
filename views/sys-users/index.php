<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\OccupancyIssueSearch;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sys Users';
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
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
	  <div class="leftbar col-md-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#landlord" role="tab">Landlords</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tenant" role="tab">Tenant by Landlord</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#issue" role="tab">Issues</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#imprest" role="tab">Imprest</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#disbursement" role="tab">Disbursement</a></li>
				
				
			</ul> 
			</div>
		<div class="rightbar col-md-10">
			<div class="tab-content">
				<div class="tab-pane active" id="landlord" role="tabpanel">
					<div class="sys-users-index">

            <p>
                <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'sys-users/create', 'Users', 'btn btn-danger btn-create');
                ?>
            </p>
             <?php Pjax::begin(['id'=>'pjax-sys-users',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'fk_group_id',
                    'username',
                    'pass',
                    'name1',
                    // 'name2',
                    // 'name3',
                    // 'age',
                    // 'email:email',
                    // 'phone',
                    // 'address:ntext',
                    // 'date_added',
                    // 'gender',
                    // 'color_code',
                    // 'icon_id',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
					 'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['sys-users/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "sys-users/view", "Users", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['sys-users/update', 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "sys-users/update", "Users", 'glyphicon glyphicon-edit','',$url,'Users');
                                    },
                                    
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
      </div>
	  <div class="tab-pane active" id="tenant" role="tabpanel"></div>
	  <div class="tab-pane " id="issue" role="tabpanel">
	  <?php
			$searchModel = new OccupancyIssueSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-issue/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]); 	  ?>
	  </div>
	  <div class="tab-pane " id="imprest" role="tabpanel"></div>
	  <div class="tab-pane " id="disbursement" role="tabpanel"></div>
	  </div>
	  </div>
</div>
</div>

