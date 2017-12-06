<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\Accounts;
use yii\widgets\Pjax;
use app\models\Journal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\accountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index panel panel-danger admin-content">
    <div class="panel-heading">
        <h1>Financial Records</h1>
    </div>
    <div class="panel-body">
	 <ul class=" nav nav-pills nav-stacked">
             <?php  echo Journal::showButtons();  ?>
         </ul>
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
	    <?php 
		  $dh = new DataHelper();
		  $url = Url::to(['accounts/create']);  //'site/update-data'
		   echo $dh->getModalButton(new Accounts, 'accounts/create', 'Accounts', 'btn btn-danger btn-create btn-new pull-right','New Account',$url);
	    ?> 
        </p>
        <?php Pjax::begin(['id'=>'pjax-accounts',]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'account_name',
            'account_description:ntext',
            'account_no',
            'bank_name',
            // 'branch',
            // 'bank_code',
            // 'date_created',
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
			 'template' => '{view} {update}',
			 'buttons' => [
							'view' => function ($url, $model){
								    $dh = new DataHelper();
									$url = Url::to(["accounts/view",'id'=>$model->id]);
									 // $link = Html::a('', ['#'], ['class' => 'glyphicon glyphicon-eye-open', 'onClick'=>"ajaxUniversalGetRequest('$url','event-index','', 1); return false;"]);
									  $popup = $dh->getModalButton($model, "accounts/view", "Account", 'glyphicon glyphicon-eye-open','',$url);
													
									  return $popup;
									 
							},
							'update' => function ($url, $model) {
								
									$dh = new DataHelper();
									$url = Url::to(["accounts/update",'id'=>$model->id]);
									 return $dh->getModalButton($model, "accounts/update", "Account", 'glyphicon glyphicon-edit','',$url);
								
									 
							},
					],
			],


        ],
    ]); ?>
	<?php Pjax::end(); ?>
    </div>
    

</div>
