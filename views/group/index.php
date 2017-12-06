<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\GroupSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-danger">
      <div class="panel-heading">
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
        <div class="group-index">

            <p>
               <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\Group, 'group/create', 'Groups', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-group',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'group_name',
                    '_status',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "group/view", "Groups", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "group/update", "Groups", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
      </div>
</div>