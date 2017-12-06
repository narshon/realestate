<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\AdvertFeature;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\AdvertFeatureSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advert Features';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-feature-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
         <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new AdvertFeature, 'advert-feature/create', 'Adverisements', 'btn btn-danger btn-create');
                ?>
    </p>
    <?php Pjax::begin(['id'=>'pjax-advert-feature',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_advert_id',
            'fk_feature_id',
            'feature_narration:ntext',
            'image1:ntext',
            // 'image2:ntext',
            // 'image3:ntext',
            // '_status',
            // 'date_created',
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "advert-feature/view", "Adverisements", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "advert-feature/update", "Adverisements", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                                            
        ],
    ]); ?>
      <?php Pjax::end(); ?>
</div>
