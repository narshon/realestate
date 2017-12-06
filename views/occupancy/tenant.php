<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Tenant;
use app\utilities\DataHelper;
use yii\widgets\Pjax;

?>
<?php 
   echo "<h3> Occupants of ".app\models\Property::getName($property_id)."</h3>";
Pjax::begin(['id'=>'pjax-occupancy',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'fk_sublet_id',
                    'fk_user_id',
                    'start_date',
                    'end_date',
                    // 'notes:ntext',
                    '_status',
                    // 'date_created',
                    // 'created_by',
                    // 'date_modified',
                    // 'modified_by',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "occupancy/view", "Occupancy", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "occupancy/update", "Occupancy", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                ],
            ]); ?>
             <?php Pjax::end(); ?>