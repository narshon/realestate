<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\models\Ward;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ward-one-index">

    <p>
        <?php 
					$dh = new DataHelper();
					  $url=Url::to(['ward-one/create']);
                       echo $dh->getModalButton(new \app\models\wardOne, 'ward-one/create', 'Ward', 'btn btn-danger btn-create',"New",$url,"WardOne");
                    ?>
    </p>
    <?php Pjax::begin(['id'=>'pjax-ward-one',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_subcounty',
            'ward_name',
            'ward_desc:ntext',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['ward-one/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "ward-one/view", "Wards", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['ward-one/update', 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "ward-one/update", "Wards", 'glyphicon glyphicon-edit','',$url);
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
