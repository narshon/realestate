<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\utilities\DataHelper;
use app\models\Account;
use app\models\AccountEntries;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountEntriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Entries';

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



<div class="account-entries-index panel panel-danger admin-content">
<div class="panel-heading">
        <h1>Financial Records</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
      // $session = Yii::$app->session->remove('AccountEntries-0');
      // print_r($_SESSION);
    ?>
   </div>

	<div class="panel-body">
	<div class="leftbar col-md-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#entries" role="tab">Account Entries</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#report" role="tab">I&E Report</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#l-statement" role="tab">Landlord statement</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#t_statement" role="tab">Tenant Statement</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#A-statement" role="tab">Account staement</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#c-commission" role="tab">Commission Statement</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#d-report" role="tab">Daily Reports</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#m-report" role="tab">Monthly Report</a></li>
				
			</ul> 
		</div>
		
	<div class="rightbar col-md-10">
	<div class="tab-content">
	
	<div class="tab-pane active" id="entries" role="tabpanel">
	 <ul class=" nav nav-pills nav-stacked">
             <?php  echo AccountEntries::showButtons();  ?>

         </ul>

    <div class="tab-content">
        <div id="account-entries" class="tab-pane fade in active">
	 <div class="account-entries-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
	<?php  echo AccountEntries::actionButtons();  ?>
    </p>
	<?php Pjax::begin(['id'=>'pjax-account-entries',]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
           
			[
               'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'attribute' => 'fk_account_chart',
                  
                    'header'=>'Account Chart',
                    'format' => 'raw',
                    'value'=>function ($data) {
                               return isset($data->fkAccountChart->name)?$data->fkAccountChart->name:"";
                            },
			],
            'trasaction_type',
            'amount',
            'entry_date',
            // 'created_on',
            // 'created_by',

             ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
									'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['account-entries/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "account-entries/view", "AccountEntries", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
									},
											  
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['account-entries/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "account-entries/update", "AccountEntries", 'glyphicon glyphicon-edit','',$url);
                                            },
                            ], 
                    ],
        ],
    ]); ?>
	<?php Pjax::end(); ?>
</div>	
</div>

		<div id="source" class="tab-pane fade ">
          <?php
          $osearch = new app\models\SourceSearch;
          $omodel = new app\models\Source;
          $odataProvider = $osearch->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/source/index', [
                  'dataProvider' => $odataProvider,
                  'searchModel' => $osearch,
                  'model'=>$omodel
            ]);
          ?>
        </div>
		
		<div id="account-chart" class="tab-pane fade">
          <?php
          $osearch = new app\models\AccountChartSearch;
          $omodel = new app\models\AccountChart;
          $odataProvider = $osearch->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/account-chart/index', [
                  'dataProvider' => $odataProvider,
                  'searchModel' => $osearch,
                  'model'=>$omodel
            ]);
          ?>
        </div>
		
		
		<div id="account-map" class="tab-pane fade">
          <?php
          $osearch = new app\models\AccountMapSearch;
          $omodel = new app\models\AccountMap;
          $odataProvider = $osearch->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/account-map/index', [
                  'dataProvider' => $odataProvider,
                  'searchModel' => $osearch,
                  'model'=>$omodel
            ]);
          ?>
        </div>
		
		<div id="account-type" class="tab-pane fade">
          <?php
          $osearch = new app\models\AccountTypeSearch;
          $omodel = new app\models\AccountType;
          $odataProvider = $osearch->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/account-type/index', [
                  'dataProvider' => $odataProvider,
                  'searchModel' => $osearch,
                  'model'=>$omodel
            ]);
          ?>
        </div>
	
    </div>
	</div>

	
	<div class="tab-pane" id="report" role="tabpanel">1</div>
	<div class="tab-pane" id="l-statement" role="tabpanel">2</div>
	<div class="tab-pane" id="t_statement" role="tabpanel">1</div>
	<div class="tab-pane" id="A-statement" role="tabpanel">4</div>
	<div class="tab-pane" id="c-commission" role="tabpanel">5</div>
    <div class="tab-pane" id="d-report" role="tabpanel">
        <?=$this->render('partials/d_rep_stats')?>
        <div class ="summary">
            <div class="summary-loader"></div>
            <div class="summary-content">
                
            </div>
        </div>
    </div>
	<div class="tab-pane" id="m-report" role="tabpanel">7</div>

	</div>
	</div>
	</div>
	



