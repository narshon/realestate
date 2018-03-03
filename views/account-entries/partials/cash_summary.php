<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php Pjax::begin(); ?><?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' =>'property',
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                   // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          
                          //occupancyRent
                          $occupancyPayment = $originModel::findone(['id'=>$data->origin_id]);
                          if($occupancyPayment){
                              return $occupancyPayment->fkOccupancy->fkProperty->property_name;
                          }
                          
                      }
                      elseif($originModel == "app\models\OccupancyPayments"){
                          
                      }
                 }
               ],
                       
              [
                'attribute' =>'client',
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                   // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          
                          //occupancyRent
                          $occupancyPayment = $originModel::findone(['id'=>$data->origin_id]);
                          if($occupancyPayment){
                              return $occupancyPayment->fkOccupancy->fkProperty->property_name;
                          }
                          
                      }
                 }
               ],
               [
                'attribute' =>'property',
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                   // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          
                          //occupancyRent
                          $occupancyPayment = $originModel::findone(['id'=>$data->origin_id]);
                          if($occupancyPayment){
                              return $occupancyPayment->fkOccupancy->fkProperty->property_name;
                          }
                          
                      }
                 }
               ],
               [
                'attribute' =>'property',
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                   // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          
                          //occupancyRent
                          $occupancyPayment = $originModel::findone(['id'=>$data->origin_id]);
                          if($occupancyPayment){
                              return $occupancyPayment->fkOccupancy->fkProperty->property_name;
                          }
                          
                      }
                 }
               ],
             [
                'attribute' =>'amount',
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                      return $data->amount;
                 }
               ],
            'entry_date',
            
            /* [
                'attribute' => 'payment_method',
                'value' => function($data) {
                $list = \app\models\Lookup::getLookupValues('Payment Method');
                    return array_key_exists($data->payment_method, $list) ? $list[$data->payment_method] : $data->payment_method;
                }
            ],  
            [
                'attribute' => 'status',
                'value' => function($data) {
                $list = \app\models\Lookup::getLookupValues('Payment Status');
                    return array_key_exists($data->status, $list) ? $list[$data->status] : $data->status;
                }
            ], */
           // 'ref_no',
            [
                'attribute' => 'created_by',
                'value' => function($data) {
                
                    return implode(' - ', \app\models\Users::getDetail(['id','username'],$data->created_by ));
                }
            ],
            'created_on',
            // 'modified_by',
            // 'modified_on',
            
        ],
    ]); ?>
<?php Pjax::end(); ?>