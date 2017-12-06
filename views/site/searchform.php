<?php
use \app\models\Property;
?>
<div class="searchform">
    <h2>Welcome to GetKeja, where you find your next home.</h2>
    <div class="panel panel-danger searchpanel">
      <div id="home" class="tab-pane fade in active">
           <br/>
         <?php echo Yii::$app->controller->renderPartial('../property/searchform',['model'=>new Property()]); ?>
       </div>
       
        
  </div>
</div>
