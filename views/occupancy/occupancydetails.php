<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Occupancy;
use app\models\OccupancyRent;
use app\models\OccupancyTerm;
use app\models\Tenant;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use app\models\TenantSearch;
use app\models\OccupancyPaymentsSearch;
use app\models\OccupancyRentSearch;
use app\models\OccupancyTermSearch;
use app\models\OccupancySearch;
use yii\helpers\Url;
use app\models\PropertyTermSearch;
use app\models\OccupancyPayments;
$dh = new DataHelper();
?>
 <?php
    $occupancy = Occupancy::findone($occupancy_id);
    if($occupancy){
      //edit link
        $editurl = Url::to(['occupancy/update','id'=>$occupancy_id]);
        $editlink =  $dh->getModalButton($occupancy, "occupancy-term/create", "Occupancy", 'glyphicon glyphicon-edit','',$editurl);
        $statusMessage = $occupancy->getStatus()=="OFF"?"TENANT LEFT THIS OCCUPANCY":"TENANT STILL IN OCCUPANCY";
        echo <<<EOF
          <div>  
           <h3> {$occupancy->fkProperty->getPropertyNameLink()} {$occupancy->fkSublet->sublet_name} </h3>
        </div>
        <div>  
           <p> Occupied On: {$occupancy->start_date} To: {$occupancy->getEndDate()} Status: {$occupancy->getStatus()} - $statusMessage $editlink </p>
           
        </div><div class="clear"></div>
EOF;
    
    
    $url = Url::to(['occupancy-term/create','occupancy_id'=>$occupancy_id]);
    echo $dh->getModalButton($occupancy, "occupancy-term/create", "Occupancy", 'btn btn-default pull-right','Add Term',$url)."&nbsp;&nbsp;&nbsp;";
    
    $url = Url::to(['occupancy-payments/create','id'=>$occupancy_id]);
    echo $dh->getModalButton($occupancy, "occupancy-payments/create", "Occupancy", 'btn btn-default pull-right','Make Payment',$url)."&nbsp;&nbsp;&nbsp;";
    
    $url = Url::to(['occupancy-rent/create','occupancy_id'=>$occupancy_id]);
    echo $dh->getModalButton($occupancy, "occupancy-rent/create", "Occupancy", 'btn btn-default pull-right','Add Bill',$url)."&nbsp;&nbsp;&nbsp;";
    
   /* echo  Html::button('<i class="glyphicon glyphicon-ok">  Make Payment</i>', [
                            'type'=>'button',
                            'title'=>'Receiving Payment', 
                            'format'=>'json',
                            'class'=>'btn btn-default btn-create showModalButton specmargin pull-right', 
                            'value' => yii\helpers\Url::to(['occupancy-payments/create', 'id' => $occupancy->id])])."&nbsp;&nbsp;&nbsp;";  
    
    echo Html::button('<i class="glyphicon glyphicon-plus">  Add Bill</i>', [
                                     'type'=>'button',
                                     'title'=>'Add Bill', 
                                     'class'=>'btn btn-default showModalButton pull-right', 
                                     'value' => yii\helpers\Url::to(['occupancy-rent/create','occupancy_id'=>$occupancy_id])]
                             );  */
    }
                
      ?> 
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                          <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#rent" role="tab">Bills</a></li>
                          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payment" role="tab">Payments</a></li>
                          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#terms" role="tab">Terms</a></li>


                </ul>
                <div class="tab-content">
            
        
                <div id="rent" class="tab-pane active fade in" role="tabpanel">
                <?php

                     $searchModel = new OccupancyRentSearch();
                     $dataProvider =   new ActiveDataProvider(['query' => OccupancyRent::find()->where(['fk_occupancy_id'=>$occupancy_id])->orderBy("id desc")]); //$searchModel->search(Yii::$app->request->get()); 
                    echo Yii::$app->controller->renderPartial("../occupancy-rent/index", [
                    'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'occupancy'=> new Occupancy() 
                ]);    ?>
              </div>

              <div id="payment" class="tab-pane" role="tabpanel">
                <?php

                     $searchModel = new OccupancyPaymentsSearch();
                     $dataProvider = new ActiveDataProvider(['query' => OccupancyPayments::find()->where(['fk_occupancy_id'=>$occupancy_id])->orderBy("id desc")]);
                    echo Yii::$app->controller->renderPartial("../occupancy-payments/index", [
                    'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'occupancy'=> new Occupancy()
                ]);  
                    ?>
              </div>

              <div id="terms" class="tab-pane" role="tabpanel">
                <?php

                     $searchModel = new OccupancyTermSearch();
                     $dataProvider = new ActiveDataProvider(['query' => OccupancyTerm::find()->where(['fk_occupancy_id'=>$occupancy_id])->orderBy("id desc")]);
                    echo Yii::$app->controller->renderPartial("../occupancy-term/index", [
                    'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'occupancy'=> new Occupancy()
                ]);    ?>
              </div>
             </div>