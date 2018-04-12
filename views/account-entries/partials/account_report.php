<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
//use kartik\grid\GridView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h3> <?php echo $account->name; ?> Statement</h3>
<?php Pjax::begin(); ?><?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'entry_date',
            [
                'attribute' =>'property',
				'label' => 'Property/Account',
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
                      elseif($originModel == "app\models\LandlordImprest"){
                          //LandlordImprest
                          $imprest = $originModel::findone(['id'=>$data->origin_id]);
                          if($imprest){
                              $prop_name = '';
                              //get properties of this landlord
                              $properties = \app\models\Property::find()->where(['owner_id'=>$imprest->fk_landlord])->all();
                              if($properties){
                                  foreach($properties as $property){
                                      $prop_name .= $property->property_name.', ';
                                  }
                                  //remove trailing comma
                                  $prop_name = substr($prop_name, 0, -2);
                              }
                              return $prop_name;
                          }
                          
                      }
                        elseif($originModel == "app\models\Term"){
                                $term = $originModel::findone(['id'=>$data->origin_id]);
                                if($term)
                                {
                                        return $term->term_name;
                                }
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
                              return $occupancyPayment->fkOccupancy->fkTenant->getNames();
                          }
                      }
                      elseif($originModel == "app\models\LandlordImprest"){
                          //LandlordImprest
                          $imprest = $originModel::findone(['id'=>$data->origin_id]);
                          if($imprest){
                             return $imprest->fkLandlord->getNames();
                          }
                          
                        }
					elseif($originModel == "app\models\Term"){
						return "Official";
					}
                 }
               ],
               [
                'attribute' =>'client_type',
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                    // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          return "Tenant";
                      }
                      elseif($originModel == "app\models\LandlordImprest"){
                          //LandlordImprest
                          return "Landlord";
                          
                        }
					elseif($originModel == "app\models\Term"){
						return "Staff";
					}
                 }
               ],
               [
                'attribute' =>'item',
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                    // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          //occupancyRent
                         return "Tenant Payments";
                         
                      }
                      elseif($originModel == "app\models\LandlordImprest"){
                          //LandlordImprest
                          return "Landlord Payments";
                          
                        }
					 elseif($originModel == "app\models\Term"){
						return $data->particulars;
					}
                 }
               ],
             [
                'attribute' =>'amount',
                 'label'=>"Dr",
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                     if($data->trasaction_type == "debit"){
                      return $data->amount;
                     }
                 },
              //  'pageSummary' => true
               ],
              [
                'attribute' =>'amount',
                'label'=>"Cr",
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                      if($data->trasaction_type == "credit"){
                      return $data->amount;
                     }
                 },
              //  'pageSummary' => true
               ],
              
            
        ],
    ]); ?>
<?php Pjax::end(); ?>