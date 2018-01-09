<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\AccountChart;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountChartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Charts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-chart-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
         <?php 
		  $dh = new DataHelper();
		  $url = Url::to(['account-chart/create']);  //'site/update-data'
		   echo $dh->getModalButton(new AccountChart, 'account-chart/create', 'AccountChart', 'btn btn-danger btn-create btn-new pull-right','New',$url);
		   
         ?>
    </p>
	<?php Pjax::begin(['id'=>'pjax-account-chart',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            'fk_re_account_type',
            'status',
            // 'description:ntext',
            // 'created_by',
            // 'modified_by',
            // 'created_on',
            // 'modified_on',

                               ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
									'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['account-chart/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "account-chart/view", "AccountChart", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
									},
											  
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['account-chart/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "account-chart/update", "AccountChart", 'glyphicon glyphicon-edit','',$url);
                                            },
                            ], 
                    ],
        ],
    ]); ?>
	<?php Pjax::end(); ?>
</div>
