<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\TenantFavourite;
use app\models\TenantPreference;
use app\utilities\DataHelper;
use app\models\Tenant;
use yii\widgets\Pjax;
use app\models\TenantFavouriteSearch;
use app\models\TenantPreferenceSearch;

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


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenants';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
	
    <div class="panel-body">
	<div class="leftbar col-md-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tenant" role="tab">Tenants</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#area" role="tab">Tenant by Area</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#status" role="tab">Rent status</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#shifted" role="tab">shifted tenant</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#locked" role="tab">Locked Tenant</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#account" role="tab">Tenant statement of account</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#evicted" role="tab">Evicted tenant</a></li>
				
			</ul> 
		</div>
        <!-- <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><?= $this->title; ?></a></li>
            <li><a data-toggle="tab" href="#preference">Tenant Preferences </a></li>
            <li><a data-toggle="tab" href="#favourite">Tenant Favourites </a></li>
        </ul>-->
		<div class="rightbar col-md-9">
        <div class="tab-content">
      <div class="tab-pane active" id="tenant" role="tabpanel">
        <div class="tenant-index">

            <p>
                <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'tenant/create', 'Tenants', 'btn btn-danger btn-create');
                       
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-tenant',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'fk_user_id',
                    'tenant_desc:ntext',
                    'date_created',
                    'created_by',
                    // 'date_modified',
                    // 'modified_by',
                    // '_status',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "tenant/view", "Tenants", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "tenant/update", "Tenants", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
      </div>
<div class="tab-pane" id="area" role="tabpanel"></div>
 <div class="tab-pane" id="status" role="tabpanel"> </div>
 <div class="tab-pane" id="shifted" role="tabpanel"></div>
 <div class="tab-pane" id="locked" role="tabpanel"> </div>
 <div class="tab-pane" id="account" role="tabpanel"></div>
 <div class="tab-pane" id="evicted" role="tabpanel"> </div>

    </div>
        
    </div>
</div>
    