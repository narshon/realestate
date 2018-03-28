
<h3>Rent Income for: <?= date('d-m-Y')  ?></h3>
<?php // echo $in_string; ?>
<?= yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'attribute'=>'property',
                'value'=>function($data){
                    return isset($data->fkOccupancy)?$data->fkOccupancy->fkProperty->property_name:'';
                }
            ],
            [
                'attribute'=>'sublet',
                'value'=>function($data){
                    return isset($data->fkOccupancy)?$data->fkOccupancy->fkSublet->sublet_name:'';
                }
            ],
            [
                'attribute'=>'client',
                'value'=>function($data){
                    return isset($data->fkTenant)?$data->fkTenant->getNames():'';
                }
            ],
            [
                'attribute'=>'term',
                'value'=>function($data){
                    return isset($data->fkTerm)?$data->fkTerm->term_name:'';
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
                    $status = app\models\Lookup::getLookupCategoryValue(app\models\LookupCategory::getLookupCategoryID("Match Bills"), $data->_status);
                    if($status == "Matched"){
                        return "Paid";
                    }
                    else{
                        return "Not Paid";
                    }
                }
            ],  
            
                ],
            ]); ?>