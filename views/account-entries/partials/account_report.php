<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;
use app\models\Term;
use kartik\grid\GridView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
<div id="ac-id">
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

<div class="col-md-2 pull-right">
        <?= '<label class="control-label">Accounts</label>'?>
        <?=kartik\widgets\Select2::widget([
            'name' => 'account_statement',
            'id' => 'account-statement',
            'data' => \app\models\AccountChart::getAccountsOptions(),
            'options' => [
                'placeholder' => 'Select Account...',
                'multiple' => false
            ]
        ]);?>
</div>
    

<h3> <?php echo $account->name; ?> Statement</h3>
<?php Pjax::begin(); ?><?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn',
               // 'pageSummary' => false,
                ],
            'id',
            'entry_date',
            [
                'attribute' =>'client',
                'label' => 'NAME',
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
                     /* elseif($originModel == "app\models\LandlordImprest"){
                          //LandlordImprest
                          $imprest = $originModel::findone(['id'=>$data->origin_id]);
                          if($imprest){
                             return $imprest->fkLandlord->getNames();
                          }
                          
                        }
					elseif($originModel == "app\models\Term"){
						return "Official";
					} */
                 }
               ],
            [
                'attribute' =>'property',
		'label' => 'HSE',
                // 'footer' => \app\models\AccountEntries::getTotal($dataProvider->models, 'amount'),
                 'value' => function($data){
                   // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          
                          //occupancyRent
                          $occupancyPayment = $originModel::findone(['id'=>$data->origin_id]);
                          if($occupancyPayment){
                              return $occupancyPayment->fkOccupancy->fkProperty->id;
                          }
                          
                      }
                    /*  elseif($originModel == "app\models\LandlordImprest"){
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
                        } */
                 }
               ],
               [
                'attribute' =>'c_rent',
                'label' => 'C/RENT',
                 'value' => function($data){
                    // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          //get payment mappings of this transaction.
                          $pay = \app\models\OccupancyPayments::findone(['id'=>$data->origin_id]);
                          $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$data->origin_id]);
                          if($payMaps){
                              
                              $currentMonth = date("m", strtotime($pay->payment_date));
                              $currentYear = date("Y", strtotime($pay->payment_date));
                              foreach($payMaps as $payMap){
                                  //check if the bill for this mapping was for current month.
                                  if($payMap->fkOccupancyRent->fk_term == 1){ //Rent Amount
                                      if($currentMonth == $payMap->fkOccupancyRent->month && $currentYear ==  $payMap->fkOccupancyRent->year){
                                          return $payMap->amount;
                                      }
                                      
                                  }
                              }
                          }
                      }
                    return "";  
                 },
                'pageSummary' => true,
               ],
               [
                'attribute' =>'balance',
                'label' => 'BAL',
                 'value' => function($data){
                    // return $data->origin_model;
                      //get origin of this transaction
                      $originModel = $data->origin_model;
                      if($originModel == "app\models\OccupancyPayments"){
                          //get payment mappings of this transaction.
                          $pay = \app\models\OccupancyPayments::findone(['id'=>$data->origin_id]);
                          $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$data->origin_id]);
                          if($payMaps){
                              $amount = 0;
                              $currentMonth = date("m", strtotime($pay->payment_date));
                              $currentYear = date("Y", strtotime($pay->payment_date));
                              foreach($payMaps as $payMap){
                                  //check if the bill for this mapping was for current month.
                                  if($payMap->fkOccupancyRent->fk_term == Term::getRentTermID()){ //Rent Amount
                                      
                                      if($currentYear >  $payMap->fkOccupancyRent->year || $currentMonth > $payMap->fkOccupancyRent->month){
                                          $amount += $payMap->amount;
                                      }
                                      else{
                                          return "";
                                      }
                                  }
                              }
                              return $amount;
                          }
                      }
                    return "";    
                 },
                 'pageSummary' => true,
               ],
               [
                'attribute' =>'visit',
                'label' => 'Visit/Locking Fee',
                 'value' => function($data){
                    //get payment mappings of this transaction.
                    $pay = \app\models\OccupancyPayments::findone(['id'=>$data->origin_id]);
                    $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$data->origin_id]);
                    if($payMaps){
                        $visit_term_id = Term::getTermID("Visit Fees");
                        $locking_term_id = Term::getTermID("Locking Fees");
                        $cumulative = 0;
                        foreach($payMaps as $payMap){
                            //check if the bill for this mapping is what we are looking for
                            if($payMap->fkOccupancyRent->fk_term == $visit_term_id || $payMap->fkOccupancyRent->fk_term == $locking_term_id ){ //Visit fee | locking fee.
                                $cumulative += $payMap->amount;
                            }
                        }
                        return $cumulative > 0? $cumulative:"";
                    }

                    return "";    
                 },
                 'pageSummary' => true,
               ],
              [
                'attribute' =>'agency_fee',
                'label' => 'Agency Fee',
                 'value' => function($data){
                    //get payment mappings of this transaction.
                    $pay = \app\models\OccupancyPayments::findone(['id'=>$data->origin_id]);
                    $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$data->origin_id]);
                    if($payMaps){
                        $agency_term_id = Term::getTermID("Agency Fee");
                        
                        foreach($payMaps as $payMap){
                            //check if the bill for this mapping is what we are looking for
                            if($payMap->fkOccupancyRent->fk_term == $agency_term_id ){ //Agency fee.
                               return $payMap->amount;
                            }
                        }
                    }

                    return "";    
                 },
                 'pageSummary' => true,
               ],
               [
                'attribute' =>'other_fee',
                'label' => 'Other Fees',
                 'value' => function($data){
                    //get payment mappings of this transaction.
                    $pay = \app\models\OccupancyPayments::findone(['id'=>$data->origin_id]);
                    $payMaps = \app\models\OccupancyPaymentsMapping::findAll(['fk_occupancy_payment'=>$data->origin_id]);
                    if($payMaps){
                        $agency_term_id = Term::getTermID("Agency Fee");
                        $visit_term_id = Term::getTermID("Visit Fees");
                        $locking_term_id = Term::getTermID("Locking Fees");
                        $rent_term_id = Term::getRentTermID();
                        $forbiden_terms = [$agency_term_id, $visit_term_id, $locking_term_id, $rent_term_id];
                        $cumulative = 0;
                        foreach($payMaps as $payMap){
                            //check if the bill for this mapping is what we are looking for
                            if(!in_array($payMap->fkOccupancyRent->fk_term, $forbiden_terms) ){ //other fee.
                                $cumulative += $payMap->amount;
                            }
                        }
                        return $cumulative > 0? $cumulative:"";
                    }

                    return "";    
                 },
                 'pageSummary' => true,
               ],
               [
                'attribute' =>'refunds',
                'label' => 'Refunds',
                 'value' => function($data){
                    //get payment mappings of this transaction.
                    $pay = \app\models\OccupancyPayments::findone(['id'=>$data->origin_id]);
                    if($pay){
                        //check if the bill for this mapping is what we are looking for
                        if($pay->mode == 2 ){ //Refund
                           return $pay->amount;
                        }
                    }

                    return "";    
                 },
                 'pageSummary' => true,
               ],
               [
                'attribute' =>'amount',
                'label' => 'Total',
                 'value' => function($data){
                    if($data->trasaction_type == "credit"){
                         return (0-$data->amount);
                     }
                     else{
                         return $data->amount;
                     }
                 },
                 'pageSummary' => true,
                       
               ],
        ],
    ]); ?>
<?php Pjax::end(); ?>

</div>
</div>
</div>
</div>