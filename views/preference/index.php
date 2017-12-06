<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preferences';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-danger">
      <div class="panel-heading">
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
          <div class="preference-index">

            <p>
               <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'preference/create', 'Preferences', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-preference',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'fk_feature',
                    'preference_title',
                    'preference_desc:ntext',
                    '_status',
                    // 'date_created',
                    // 'created_by',
                    // 'date_modified',
                    // 'modified_by',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "preference/view", "Preferences", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "preference/update", "Preferences", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
      </div>
</div>
