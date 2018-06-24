<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\AccountType;
use yii\widgets\Pjax;
use app\models\AccountEntries;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Types';
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
<div class="account-type-index  admin-content">

        <h1><?= Html::encode($this->title) ?></h1>
    <p>
	<?php
        $dh = new DataHelper();
						 $url=Url::to(['account-type/create']);
                       echo $dh->getModalButton(new AccountType, 'account-type/create', 'AccountType', 'btn btn-danger btn-create btn-new pull-right' , "New",$url);
               ?>
    </p>
	<?php Pjax::begin(['id'=>'pjax-account-type',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'Description',
            //'created_by',
            //'modified_by',
            // 'created_on',
            // 'modified_on',

                                ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
									'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['account-type/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "account-type/view", "AccountType", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
									},
											  
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['account-type/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "account-type/update", "AccountType", 'glyphicon glyphicon-edit','',$url);
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