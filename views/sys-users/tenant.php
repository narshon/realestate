<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\OccupancyIssueSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenants';
//$this->params['breadcrumbs'][] = $this->title;

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
	
     <div class="sys-users-index">
                     <p>
                <?php 
                      $dh = new DataHelper();
                      $url = Url::to('tenantform');
                       echo $dh->getModalButton(new \app\models\Users, 'sys-users/tenantform', 'Users', 'btn btn-danger btn-create',"New",$url,"Users");
                       
                       $url = Url::to(['occupancy/calculate']);
                       echo kartik\helpers\Html::a("Calculate Dues","#",['class'=>"btn btn-danger pull-right",'id'=>"calculate-tenant-dues",'onclick'=>"ajaxUniversalGetRequest('$url','calculate-tenant-dues','', 1); return false;"]);
                       
                ?>
            </p>
             <?php // Pjax::begin(['id'=>'pjax-tenant-view',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                       'label'=> 'Name1',
                      'format' =>'raw',
                       'attribute'=>'name1',
                        'value'=>function($data){
                            return    $data->getTenantName1Link();
                        }
                    ],
                     'name2',
                     'name3',
                    'email:email',
                    'phone',
					'id_number',
                   // 'occupation',
                   // 'employer',
                    //'address:ntext',
                    // 'date_added',
                    // 'gender',
                    // 'color_code',
                    // 'icon_id',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $url = Url::to(['tenantview','id'=>$model->id]);
                                             $a = Html::a("", $url, ['class' => "glyphicon glyphicon-eye-open"]);
                                              return $a;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['tenantform','id'=>$model->id]);
                                           return $dh->getModalButton($model, "sys-users/tenantform", "Users", 'glyphicon glyphicon-edit','',$url,'Users');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php // Pjax::end(); ?>
  
        </div>
      
</div>
</div>