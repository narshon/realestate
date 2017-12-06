<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcounties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcounty-index">

    <p>
        <?php 
                     $dh = new DataHelper();
					  $url=Url::to(['subcounty/create']);
                       echo $dh->getModalButton(new \app\models\LookupCategory, 'subcounty/create', 'Subcounties', 'btn btn-danger btn-create',"New",$url,"subcounty");
           ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-subcounty',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'fkCounty',
                'value' => 'fkCounty.county_name'
             ],
            'subcounty_name',
            'subcounty_desc:ntext',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['subcounty/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "subcounty/view", "Subcounties", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['subcounty/update', 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "subcounty/update", "Subcounties", 'glyphicon glyphicon-edit','',$url);
                                     },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
