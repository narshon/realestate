<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TenantFavourite;
use app\utilities\DataHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenant Favourites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenant-favourite-index">

    <p>
    </p>
    <?php Pjax::begin(['id'=>'pjax-tenant-favourite',]); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_property_id',
            'fk_tenant_id',
            '_status',
            'date_created',
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "tenant-favourite/view", "Tenant Favourites", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "tenant-favourite/update", "Tenant Favourites", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>
</div>
