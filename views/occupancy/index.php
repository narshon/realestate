<?php

use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenant: '.$tenant->getNames();

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
<div class="panel panel-danger">
    <div class="panel-heading">
        
        <h2><?= $this->title; ?></h2>
        
    </div>
    <div class="panel-body">
        <div class="leftbar col-md-2">
            <?php
               echo \app\models\Users::getTenantTabs($tenant->id);
            ?>
    </div>
    <div class="rightbar col-md-10">
         <div class="col-md-2 pull-right">
        <?= '<label class="control-label">Select Occupancy</label>'?>
        <?= kartik\widgets\Select2::widget([
            'name' => 'occupancy',
            'id' => 'occupancy-id',
            'data' => \app\models\Occupancy::getTenantOccupancies($tenant->id),
            'options' => [
                'placeholder' => 'Select Occupancy...',
                'multiple' => false
            ]
        ]);?>
      </div> 
      <div  id="occupancy-div" class="occupancy-index">
          <?php  Pjax::begin(['id'=>'pjax-occupancy',]); ?> 
          <?php
          //get default occupancy and render view.
          $occupancy_id = \app\models\Occupancy::getDefaultOccupancy($tenant->id);
          echo  $this->render('occupancydetails', [
                'occupancy_id'=> $occupancy_id
            ]);
          ?>
            
            
             <?php  Pjax::end(); ?>

        </div>
    </div>
    </div>
    
      

</div>
    