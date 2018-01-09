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
<div class="ward-index">

    <p>
        <?php 
					$dh = new DataHelper();
					  $url=Url::to(['ward/create']);
                       echo $dh->getModalButton(new Ward, 'ward/create', 'Ward', 'btn btn-danger btn-create',"New",$url,"Ward");
                    ?>
    </p>
    <?php Pjax::begin(['id'=>'pjax-ward',]); ?> 
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
                                             $url = Url::to(['ward/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "ward/view", "Wards", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['ward/update', 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "ward/update", "Wards", 'glyphicon glyphicon-edit','',$url);
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
