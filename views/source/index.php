<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\Source;
use yii\widgets\Pjax;
use app\models\AccountEntries;

/* @var $this yii\web\View */
/* @var $searchModel app\models\sourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-index panel panel-danger admin-content">

     <div class="panel-heading">
        <h1>Financial Records</h1>
    </div>
    <div class="panel-body">
	 <ul class=" nav nav-pills nav-stacked">
             <?php  echo AccountEntries::showButtons();  ?>
         </ul>
        <h1><?= Html::encode($this->title) ?></h1>
    <p>
       <?php 
		  $dh = new DataHelper();
		  $url = Url::to(['source/create']);  //'site/update-data'
		   echo $dh->getModalButton(new source, 'source/create', 'Sources', 'btn btn-danger btn-create btn-new pull-right','New Source',$url);
		   
         ?>
    </p>
 <?php Pjax::begin(['id'=>'pjax-source',]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'source_name',
            'category',
            'source_description:ntext',
            'source_type',

           ['class' => 'yii\grid\ActionColumn',
			 'template' => '{view} {update}',
			 'buttons' => [
							'view' => function ($url, $model){
								    $dh = new DataHelper();
									$url = Url::to(["source/view",'id'=>$model->id]);
									 // $link = Html::a('', ['#'], ['class' => 'glyphicon glyphicon-eye-open', 'onClick'=>"ajaxUniversalGetRequest('$url','event-index','', 1); return false;"]);
									  $popup = $dh->getModalButton($model, "source/view", "Source", 'glyphicon glyphicon-eye-open','',$url);
													
									  return $popup;
									 
							},
							'update' => function ($url, $model) {
								
									$dh = new DataHelper();
									$url = Url::to(["source/update",'id'=>$model->id]);
									 return $dh->getModalButton($model, "source/update", "Source", 'glyphicon glyphicon-edit','',$url);
								
									 
							},
					],
			],


        ],
    ]); ?>
	<?php Pjax::end(); ?>
</div>
</div>