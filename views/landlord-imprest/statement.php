<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\LandlordImprest;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LandlordImprestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Landlord Imprests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="landlord-imprest-statement">

<div class="no-print pull-right" align=" center">
   <button class ="print-modal1" onclick="window.print();">Print</button>
</div>

<div>
    <span style="float:left; width: 60%"><h3>LANDLORD STATEMENT</h3></span> 
    <span style="float:right; width: 40%"><h3> <?php echo date("d-m-Y") ?> </h3></span> 
</div><br/><div class="clear"></div>
<div class="clear"></div>
<div>
    <span >Account: <?php echo $model->id; ?></span> 
</div><br/><div class="clear"></div>
<div>
    <?php
      $names =  $model;
      if($names){
          $names = $names->getNames();
      }
      else{
          $names = "";
      }
    ?>
    <span>Mr/Mrs: <?php echo $names ?></span> 
    <table id="t01">
  <tr>
    <th>Date</th>
    <th>Type</th> 
    <th>Amount</th> 
    <th>Narration</th>
  </tr>
  
   <?php $total_amount = 0;
    $imprests = $query->all();
    if($imprests){
        
        foreach($imprests as $imprest){
            echo "<tr>";
            echo "<td> ".$imprest->entry_date."</td>";
            echo "<td> ".$imprest->imprest_type."</td>";
            echo "<td> ".$imprest->amount."</td>";
            echo "<td> ".$imprest->narration."</td>";
            echo "</tr>";
            
            $total_amount += $imprest->amount;
            
        }
    }
   
   ?>
  
  <tr>
      <td><strong> Total </strong></td>
    <td></td> 
    <td><strong><?= $total_amount ?> </strong></td> 
    <td></td>
  </tr>
    </table>
<?php 

/* Pjax::begin(['id'=>'pjax-landlord-imprest']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'entry_date',
            'imprest_type',
          /*  [
                'attribute'=>'fk_landlord',
                'value'=>'fkLandlord.name1'                
            ],  */
            //'fk_landlord',
         //   'amount',
         //   'narration',
           
       // ],
   // ]);  ?>
<?php // Pjax::end(); ?>

</div>
</div>
