<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\OccupancyIssueSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Landlords';
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

	  <div class="tab-pane active" id="landlord" role="tabpanel">
		<div class="sys-users-index">

            <p>
                <?php 
                      $dh = new DataHelper();
                      $url = Url::to('landlordform');
                       echo $dh->getModalButton(new \app\models\Users, 'sys-users/landlordform', 'Users', 'btn btn-danger btn-create',"New",$url,"Users");
                ?>
            </p>
             <?php Pjax::begin(['id'=>'pjax-sys-users',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name1',
                     'name2',
                     'name3',
                    'email:email',
                    'phone',
					'id_number',
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
                                              $url = Url::to(['landlordview','id'=>$model->id]);
                                             $a = Html::a("", $url, ['class' => "glyphicon glyphicon-eye-open"]);
                                              return $a;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['landlordform','id'=>$model->id]);
                                           return $dh->getModalButton($model, "sys-users/landlordform", "Users", 'glyphicon glyphicon-edit','',$url,'Users');
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