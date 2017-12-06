<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;

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
                       echo $dh->getModalButton(new \app\models\Lookup, 'lookup/create', 'Lookups', 'btn btn-danger btn-create');
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
                        'attribute' => 'category0',
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
                                              $popup = $dh->getModalButton($model, "lookup/view", "Lookups", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "lookup/update", "Lookups", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
