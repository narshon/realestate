<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\Journal;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Journals';

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


<div class="journal-index panel panel-danger admin-content">
<div class="panel-heading">
        <h1>Financial Records</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
      // $session = Yii::$app->session->remove('Journal-0');
      // print_r($_SESSION);
    ?>
   </div>

	<div class="panel-body">
	<div class="leftbar col-md-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#journal" role="tab">Journal</a></li>
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
	<div class="tab-pane active" id="journal" role="tabpanel">
	 <ul class=" nav nav-pills nav-stacked">
             <?php  echo Journal::showButtons();  ?>

         </ul>

    <div class=" tab-content">
        <div id="journal" class="tab-pane fade in active">
	 <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
		  $dh = new DataHelper();
		  $url = Url::to(['journal/create']);  //'site/update-data'
		   echo $dh->getModalButton(new journal, 'journal/create', 'Journals', 'btn btn-danger btn-create btn-new pull-right','New Journal',$url);
		   
         ?>
    </p>
 <?php Pjax::begin(['id'=>'pjax-journal',]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            'receipt_invoice_no',
            
            'details:ntext',
	    [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'attribute' => 'account_type',
		'filter'=>true,
                'header'=>'Account Type',
                'value'=>function ($data) {
                            return $data->accountType->account_name;
                        },
            ],
	    [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'attribute' => 'transaction_type',
				'filter'=>true,
                'header'=>'Transaction Type',
                'value'=>function ($data) {
                            return isset($data->transactionType->source_name)?$data->transactionType->source_name:'';
                        },
            ],
             [
			 'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'attribute' => 'post_status',
		'filter'=>Journal::getStatusOptions(),
                'header'=>'Status',
                'value'=>function ($data) {
                            return $data->getStatus();
                        },
						],
            // 'date_created',
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

             ['class' => 'yii\grid\ActionColumn',
			 'template' => '{view} {update}',
			 'buttons' => [
							'view' => function ($url, $model){
								    $dh = new DataHelper();
									$url = Url::to(["journal/view",'id'=>$model->id]);
									 // $link = Html::a('', ['#'], ['class' => 'glyphicon glyphicon-eye-open', 'onClick'=>"ajaxUniversalGetRequest('$url','event-index','', 1); return false;"]);
									  $popup = $dh->getModalButton($model, "journal/view", "Journal", 'glyphicon glyphicon-eye-open','',$url);
													
									  return $popup;
									 
							},
							'update' => function ($url, $model) {
								if($model->post_status != 1){
									$dh = new DataHelper();
									$url = Url::to(["journal/update",'id'=>$model->id]);
									 return $dh->getModalButton($model, "journal/update", "Journal", 'glyphicon glyphicon-edit','',$url);
                                                                }
									 
							},
					],
			],


        ],
    ]); ?>
	<?php Pjax::end(); ?>
</div>
<div id="accounts" class="tab-pane fade">
          <?php
          $osearch = new app\models\AccountsSearch;
          $omodel = new app\models\Accounts;
          $odataProvider = $osearch->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/accounts/index', [
                  'dataProvider' => $odataProvider,
                  'searchModel' => $osearch,
                  'model'=>$omodel
            ]);
          ?>
        </div>
		
		<div id="source" class="tab-pane fade">
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
		
		<div id="account-transaction" class="tab-pane fade">
          <?php
          $osearch = new app\models\AccountsTransactionSearch;
          $omodel = new app\models\AccountsTransaction;
          $odataProvider = $osearch->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/accounts-transaction/index', [
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
	<div class="tab-pane" id="d-report" role="tabpanel">6</div>
	<div class="tab-pane" id="m-report" role="tabpanel">7</div>
	</div>
	</div>
	</div>
	
</div>
