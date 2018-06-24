<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\AccountMap;
use yii\widgets\Pjax;
use app\models\AccountEntries;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Maps';
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
<div class="account-map-index admin-content">

        <h1><?= Html::encode($this->title) ?></h1>
    <p>
	<?php
        $dh = New DataHelper();
		$url= Url::to(['account-map/create']);
		echo $dh->getModalButton(new accountMap,'account-map/create','Account Map','btn btn-danger btn-create btn-new pull-right','New',$url);
		?>
    </p>
	 <?php Pjax::begin(['id'=>'pjax-account-map',]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
           
			[
               'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'attribute' => 'fk_term',
                  
                    'header'=>'Term',
                    'format' => 'raw',
                    'value'=>function ($data) {
                               return isset($data->fkTerm->term_name)?$data->fkTerm->term_name:"";
                            },
			],
            
			[
               'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'attribute' => 'fk_account_chart',
                  
                    'header'=>'Account Chart',
                    'format' => 'raw',
                    'value'=>function ($data) {
                               return isset($data->fkAccountChart->name)?$data->fkAccountChart->name:"";
                            },
			],
            'transaction_type',
            
			[
			'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'attribute' => 'status',
                        'filter' => app\models\Lookup::getLookupValues('Status'),
                        'value' => function ($data) {
                            $category_id = \app\models\LookupCategory::getLookupCategoryID('Status');
                            return app\models\Lookup::getLookupCategoryValue($category_id, $data->status);
                        },
			],
            // 'created_on',
            // 'created_by',
            // 'modified_on',
            // 'modified_by',

           ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
									'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['account-map/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "account-map/view", "AccountMap", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
									},
											  
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['account-map/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "account-map/update", "AccountMap", 'glyphicon glyphicon-edit','',$url);
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