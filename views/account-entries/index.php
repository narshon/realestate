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
use yii\bootstrap\Collapse;

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
<div class="panel-heading no-print">
        <h1>Financial Records</h1>
   </div>

	<div class="panel-body">
	<div class="leftbar__ col-md-2 no-print">
            <ul class="nav nav-tabs" id="myTab__" role="tablist">
                              <!--  
                                
                                
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#entries" role="tab">Account Entries</a></li> -->
				<?php
				echo Collapse::widget([
                                    'items' => AccountEntries::getNavigationItems()
                                ]); ?>
	     </ul> 
	</div>
		
	<div class="rightbar col-md-10">
	<div class="tab-content">
	
	<div class="tab-pane active" id="entries" role="tabpanel">
	 <ul class=" nav nav-pills nav-stacked">
             <?php //  echo AccountEntries::showButtons();  ?>

         </ul>

    <div class="tab-content">
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
        <div class="tab-pane" id="A-statement" role="tabpanel">
            <?=$this->render('partials/account_statement')?>
            <div class ="summary">
                <div class="s-loader"></div>
                <div id="ac-id" class="s-content">

                </div>
            </div>
        </div>
    <div class="tab-pane fade in active" id="d-report" role="tabpanel">
        <?=$this->render('partials/d_rep_stats')?>
        <div class ="summary">
            <div class="summary-loader"></div>
            <div id="summary-content-div" class="summary-content">
                 <?php
                    echo Yii::$app->controller->getAssetsReport(\app\models\AccountChart::getAccountByCode(1101), 'daily');
                 ?>
            </div>
        </div>
    </div>
        <div class="tab-pane" id="rent" role="tabpanel">...e4</div>
        <div class="tab-pane" id="trial" role="tabpanel">..444.</div>
	<div class="tab-pane" id="m-report" role="tabpanel">7</div>
        
        <!-------  Settings Tabs ----------------->
	<div class="tab-pane" id="chart" role="tabpanel">
          <?php  $search = new app\models\AccountChartSearch();
          $model = new app\models\AccountChart();
          $dataProvider = $search->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/account-chart/index', [
                  'dataProvider' => $dataProvider,
                  'searchModel' => $search,
                  'model'=>$model
            ]); ?>
        </div>
	<div class="tab-pane" id="map" role="tabpanel">
          <?php  $search = new app\models\AccountMapSearch();
          $model = new app\models\AccountMap();
          $dataProvider = $search->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/account-map/index', [
                  'dataProvider' => $dataProvider,
                  'searchModel' => $search,
                  'model'=>$model
            ]); ?>
        </div>
        <div class="tab-pane" id="accounttype" role="tabpanel">Account Types
        <?php  $osearch = new app\models\AccountTypeSearch();
          $omodel = new app\models\AccountType();
          $odataProvider = $osearch->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial('/account-type/index', [
                  'dataProvider' => $odataProvider,
                  'searchModel' => $osearch,
                  'model'=>$omodel
            ]); ?>
        </div>

	</div>
	</div>
	</div>
</div>


