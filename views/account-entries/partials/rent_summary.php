<?= yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'attribute'=>'fk_source',
                'value'=>function($data){
                    return isset($data->fkSource)?$data->fkSource->source_name:'';
                }
            ],
            [
                'attribute'=>'month',
                'label' => "Period",
                'value'=>function($data){
                    return $data->getPeriod();
                }
            ],
            //'month',
            //'year',
            'amount',
            [
                'attribute'=>'_status',
                'value'=>function($data){
                    return app\models\Lookup::getLookupCategoryValue(app\models\LookupCategory::getLookupCategoryID("status"), $data->_status);
                }
            ],  
            'date_created',
             
            // 'created_by',
            // 'date_modified',
            // 'modified_by',

           /* ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "occupancy-rent/view", "Rent", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                            $dh = new DataHelper();
                                           return $dh->getModalButton($model, "occupancy-rent/update", "Rent", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ], */
                ],
            ]); ?>