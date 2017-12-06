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


?>

<div class="sys-users-index">

            <p>
                <?php 
                      $dh = new DataHelper();
					  $url=Url::to(['sys-users/create']);
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'sys-users/create', 'SysUsers', 'btn btn-danger btn-create',"New",$url,"SysUsers");
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
                                              $popup = $dh->getModalButton($model, "sys-users/view", "SysUsers", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "sys-users/update", "SysUsers", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
       
</div>
