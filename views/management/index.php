<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\OccupancyIssueSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Managements';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="panel panel-danger">
      <div class="panel-heading">
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
	<div class="management-index">

            <p>
                <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'management/create', 'Management', 'btn btn-danger btn-create','New');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-management',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'fk_user_id',
                    'management_name',
                    [
						'attribute' => 'management_type',
						'format' => 'raw',
						'value' => function ($model) {                      
								return $model->getManagementType();
						},
					],
                    'location:ntext',
                    'address:ntext',
                    // 'profile_desc:ntext',
                    // 'featured_property',
                    // 'date_created',
                    // 'created_by',
                    // 'date_modified',
                    // 'modified_by',
                    // '_status',

                   ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "management/view", "Management", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "management/update", "Management", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
        </div>
      
</div>
</div>