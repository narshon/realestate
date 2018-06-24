<?php

use yii\bootstrap\Collapse;
use kartik\grid\GridView;

$this->registerCss("
            .container{
                width:98% !important;
            }
            .leftbar{
               background: #B5121B;
               color:#ffffff !important;
               padding-top:10px;
            }
            .leftbar a{
                color:#ffffff !important;
            }
            .leftbar a:hover, a:active{
                color:#000000 !important;;
                /* background-color: #000000 !important; */
            }
            
            .rightbar{
                
            }
        "); 
?>
<div  class="account-entries-index panel panel-danger admin-content">
   <div class="panel-heading">
        <h1>Financial Records</h1>
   </div>

    <div class="panel-body">
	<div class="leftbar__ col-md-2">
            <ul class="nav nav-tabs" id="myTab__" role="tablist">
                          
                <?php
                echo Collapse::widget([
                    'items' => \app\models\AccountEntries::getNavigationItems()
                ]); ?>
	     </ul> 
	</div>
        <div id="statement_box" class="rightbar col-md-10">

        <h3> Pending Bills </h3>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'attribute'=>'tenant',
                'value'=>function($data){
                    return isset($data->fkOccupancy)?$data->fkOccupancy->fkTenant->getNames():'';
                }
            ],
            [
                'attribute'=>'fk_term',
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
                    return app\models\Lookup::getLookupCategoryValue(app\models\LookupCategory::getLookupCategoryID("Match Bills"), $data->_status);
                }
            ],  
            'date_created',
            
                ],
            ]); ?>
        </div>
    </div>
</div>