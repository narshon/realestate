<?php
  use app\models\Term;
  
 $penalty_term_ids = [Term::getTermID("Penalty Percentage"),Term::getTermID("penalty amount")];
 $other_term_ids = [Term::getTermID("Water Deposit"),Term::getTermID("Electricity Deposit"),Term::getTermID("Water Bills"),Term::getTermID("Electricity Bills"), Term::getTermID("Breaking Fee"), Term::getTermID("Storage Fee") ]; 
?>
<div id="print_area">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <table id="t01">   
              <tr>
                <th>Date</th>
                <th>Rent</th>
                <th>Lock</th>
                <th>Visit Fee</th>
                <th>Pen Fee</th>
                <th>Dep Fee</th>
                <th>Agency Fee</th>
                <th>Other Fees</th>
                <th>Total</th>
              </tr>
              
              <?php
               //loop through and generate report.
              if($query){
                  foreach($query as $data){
                      ?>
              <tr>
                <td><?php echo $data->payment_date ?></td> 
                <td><strong><?php echo $data->getAmountOfBillPaid(Term::getTermID("Rent Amount")) ?></strong></td>
                <td><strong><?php echo $data->getAmountOfBillPaid(Term::getTermID("Locking Fees")) ?></strong></td>
                <td><strong><?php echo $data->getAmountOfBillPaid(Term::getTermID("Visit Fees")) ?></strong></td>
                <td><strong><?php echo $data->getAmountOfBillPaid($penalty_term_ids) ?></strong></td>
                <td><strong><?php echo $data->getAmountOfBillPaid(Term::getTermID("Rent Deposit")) ?></strong></td>               
                <td><strong><?php echo $data->getAmountOfBillPaid(Term::getTermID("Agency Fee")) ?></strong></td>
                <td><strong><?php echo $data->getAmountOfBillPaid($other_term_ids) ?></strong></td>
                <td><strong><?php echo $data->amount ?></strong></td>
              </tr>
              
              <?php
                      
                  }
              }
              ?>
              <tr> 
                <td>Total</td> 
                <td><strong><?php echo $data->getTotalAmountOfBill(Term::getTermID("Rent Amount"),$date1,$date2,$occupancy_id) ?></strong></td>
                <td><strong><?php echo $data->getTotalAmountOfBill(Term::getTermID("Locking Fees"),$date1,$date2,$occupancy_id) ?></strong></td>
                <td><strong><?php echo $data->getTotalAmountOfBill(Term::getTermID("Visit Fees"),$date1,$date2,$occupancy_id) ?></strong></td>
                <td><strong><?php echo $data->getTotalAmountOfBill($penalty_term_ids,$date1,$date2,$occupancy_id) ?></strong></td>
                <td><strong><?php echo $data->getTotalAmountOfBill(Term::getTermID("Rent Deposit"),$date1,$date2,$occupancy_id) ?></strong></td>               
                <td><strong><?php echo $data->getTotalAmountOfBill(Term::getTermID("Agency Fee"),$date1,$date2,$occupancy_id) ?></strong></td>
                <td><strong><?php echo $data->getTotalAmountOfBill($other_term_ids,$date1,$date2,$occupancy_id) ?></strong></td>
                <td><strong><?php echo "Total"?></strong></td>
              </tr>
           </table>
            
        </div>
    </div>
</div>
