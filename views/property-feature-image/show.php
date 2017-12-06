<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Pjax::begin(['id'=>'pjax-property-feature-image-show', 'timeout' => 5000]); 

//query existing images of this property feature and display them in thumbnails.
$images = app\models\PropertyFeatureImage::getPropertyFeatureImages($property_feature_id);
if($images){
    foreach($images as $image){
    ?>
   <div class="panel panel-danger col-lg-3 img-custompanel">
              <div class="panel-heading custompanelheading" style='width:100%;'>
                  <?= $image->image_title ?>
            </div>
             <div class="panel-body custompanelbody">
                  
                  <div class='panel-image'> 
                    <?php  $url =  Url::to(['property-feature-image/update', 'id'=>$image->id]);
                          $image_url = Url::to('@web/uploads/'.$image->image_url, true);
                      //echo Html::Button("Edit", ['class' =>'btn btn-danger btn-create btn-property-feature-image','onclick'=>" ajaxUniversalGetRequest('$url','image-div','', 1); return false;"]); 
                     ?>
                      <a onclick="ajaxUniversalGetRequest('<?= $url ?>','image-div','', 1); return false;" href="#">
                      <img src='<?= $image_url ?>' width='100%' /> </div>
                     </a>
                   <?php
                   
                      echo $image->image_caption.'<br/><strong> Status: </strong> '.$image->getStatus();
                              
                   ?>
                </div>
            </div>
    <?php }
}
?>
<?php // Pjax::end(); ?>

