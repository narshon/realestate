<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\AccountMap;
use yii\widgets\Pjax;
use app\models\AccountEntries;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Maps';
$this->params['breadcrumbs'][] = $this->title;
?><div class="account-map-index panel panel-danger admin-content">

     <div class="panel-heading">
        <h1>Financial Records</h1>
    </div>
	
    <div class="panel-body">
	 <ul class=" nav nav-pills nav-stacked">
             <?php  echo AccountEntries::showButtons();?>
         </ul>
        <h1><?= Html::encode($this->title) ?></h1>
    <p>
	<?php
        $dh = New DataHelper();
		$url= Url::to(['account-map/create']);
		echo $dh->getModalButton(new accountMap,'account-map/create','Account Map','btn btn-danger btn-create btn-new pull-right','New',$url);
		?>
    </p>
	 <?php Pjax::begin(['id'=>'pjax-account-map',]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_term',
            'fk_account_chart',
            'transaction_type',
            'status',
            // 'created_on',
            // 'created_by',
            // 'modified_on',
            // 'modified_by',

           ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
									'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['account-map/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "account-map/view", "AccountMap", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
									},
											  
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['account-map/update','id'=>$model->id]);
                                           return $dh->getModalButton($model, "account-map/update", "AccountMap", 'glyphicon glyphicon-edit','',$url);
                                            },
                            ], 
                    ],
        ],
    ]); ?>
	<?php Pjax::end(); ?>
</div>
</div>
