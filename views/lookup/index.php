<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\models\Lookup;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lookups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
			$dh = new DataHelper();
			$url=Url::to(['lookup/create']);
                       echo $dh->getModalButton(new Lookup, 'lookup/create', 'Lookups', 'btn btn-danger btn-create',"New",$url,"Lookup");
                    ?>
         
    </p>
     <?php Pjax::begin(['id'=>'pjax-lookup',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            '_key',
            '_value:ntext',
            [
                        'attribute' => 'category',
                        'value' => 'category0.category_name'
                    ],
            '_order',
            // '_status',
            // 'created_by',
            // 'date_created',
            // 'modified_by',
            // 'date_modified',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['lookup/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "lookup/view", "Lookups", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['lookup/update', 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "lookup/update", "Lookups", 'glyphicon glyphicon-edit','',$url);
                                     },
                            ], 
                    ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
