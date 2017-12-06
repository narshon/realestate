<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\models\Term;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-danger">
      <div class="panel-heading">
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
          <div class="term-index">
            <p>
                <?php 
                      $dh = new DataHelper();
                      $url=Url::to(['term/create']);
                       echo $dh->getModalButton(new Term, 'term/create', 'Terms', 'btn btn-danger btn-create',"New",$url,"Term");
                       
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-term',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    //'term_type',
                    'term_name',
                    'term_desc:ntext',
                   // '_status',
                    // 'date_created',
                    // 'created_by',
                    // 'date_modified',
                    // 'modified_by',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['term/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "term/view", "Terms", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                              
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['term/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "term/update", "Term", 'glyphicon glyphicon-edit','',$url);
                                           
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
      </div>
</div>