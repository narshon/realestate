<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
    <span style="float:left; width: 60%"><h3>LANDLORD PAYMENT ADVICE</h3></span> 
    <span style="float:right; width: 40%"><h3> <?php echo date("d-m-Y") ?> </h3></span> 
</div><br/><div class="clear"></div>
<div>
    <span style="float:left; width: 60%">Month: September</span> 
    <span style="float:right; width: 40%">Our Ref: 12345</span> 
</div><br/><div class="clear"></div>
<div>
    <span >Account: 025</span> 
</div><br/><div class="clear"></div>
<div>
    <?php
      $names =  \app\models\Users::find()->where(["id"=>$owner_id])->one();
      if($names){
          $names = $names->getNames();
      }
      else{
          $names = "";
      }
    ?>
    <span>Mr/Mrs: <?php echo $names ?></span> 
</div><br/><div class="clear"></div>
<?php
/*
echo "Uncleared Bills = ".print_r($bills,true)."<br/>";
echo "Cleared Bills = ".print_r($cleared_bills,true)."<br/>";
echo "Advance_ids = ".$model->payments_advance_ids."<br/>";
echo "Owner ID = ".$owner_id."<br/>";
*/
?>
<table id="t01">
  <tr>
    <th>Tenant's Name</th>
    <th>Period</th> 
    <th>Paid By Tenant</th>
    <th>Paid By Agent</th>
    <th>Total</th>
  </tr>
  <tr>
    <td>Jill Smith</td>
    <td>Feb/2018</td>
    <td>2000</td>
    <td>500</td>
    <td>2500</td>
  </tr>
  
</table>