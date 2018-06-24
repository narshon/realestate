<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\AccountChart;
use yii\widgets\Pjax;
use app\models\AccountEntries;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountChartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap\Collapse;


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
<div  class="account-entries-index panel panel-danger admin-content">
   <div class="panel-heading">
        <h1>Financial Records</h1>
   </div>

    <div class="panel-body">
	<div class="leftbar__ col-md-2">
            <ul class="nav nav-tabs" id="myTab__" role="tablist">
                          
                <?php
                echo Collapse::widget([
                    'items' => \app\models\AccountEntries::getNavigationItems()
                ]); ?>
	     </ul> 
	</div>
        <div id="statement_box" class="rightbar col-md-10">

        <div class="account-chart-index admin-content">

        <h1><?= Html::encode("Charts of Accounts") ?></h1>
    <p>
         <?php 
		  $dh = new DataHelper();
		  $url = Url::to(['account-chart/create']);  //'site/update-data'
		   echo $dh->getModalButton(new AccountChart, 'account-chart/create', 'AccountChart', 'btn btn-danger btn-create btn-new pull-right','New',$url);
		   
         ?>
    </p>
	<?php Pjax::begin(['id'=>'pjax-account-chart',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
           
			[
			 'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'attribute' => 'fk_re_account_type',
                  
                    'header'=>'Account Type',
                    'format' => 'raw',
                    'value'=>function ($data) {
                               return isset($data->fkReAccountType->name)?$data->fkReAccountType->name:"";
                            },
			],
            
			[
			'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'attribute' => 'status',
                        'filter' => app\models\Lookup::getLookupValues('Status'),
                        'value' => function ($data) {
                            $category_id = \app\models\LookupCategory::getLookupCategoryID('Status');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->status);
                        },
			],
            // 'description:ntext',
            // 'created_by',
            // 'modified_by',
            // 'created_on',
            // 'modified_on',

                               ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
									'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['account-chart/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "account-chart/view", "AccountChart", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
									},
											  
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['account-chart/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "account-chart/update", "AccountChart", 'glyphicon glyphicon-edit','',$url);
                                            },
                            ], 
                    ],
        ],
    ]); ?>
	<?php Pjax::end(); ?>
       </div>

        </div>
    </div>
</div>
