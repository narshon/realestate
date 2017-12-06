<?php

$this->title = 'Real Estate Pro';
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
//use yii\helpers\Html;

?>

<!--<div class="panel panel-danger">
            <div class="panel-body">
                <h2>Recent Properties For Rent </h2>
	     <div class="row">
                  <?php 
                    $dataProvider = new ActiveDataProvider([
                         'query' => \app\models\Property::find(),
                        'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
                     ]);
                    $dataProvider->pagination->pageSize=12;
                   echo  ListView::widget([
                             'dataProvider' => $dataProvider,
                             'itemOptions' => ['class' => 'item col-lg-3'],
                             'itemView' => function ($model, $key, $index, $widget) {
                                     return $model->propertyPost();
                             },
                     ]); 
                ?>     

              </div>
            </div>  
        </div> -->
		<?php
use yii\web\View;
use app\models\Property;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;


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
<h2>Administration Section</h2>


<div class="panel panel-default">
    
    <div class="panel-body">
         <div class="leftbar col-md-2">
            <ul class="nav nav-pills nav-stacked">
              <li><?php echo Html::a('Properties', ['admin', 'route' => 'Property','view'=>'property'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Features', ['admin', 'route' => 'Feature','view'=>'feature'], ['class' => '']);  ?></li>  <!-- <a href="#feature" id="Feature__feature" class="load_data">  </a> -->
              <li><?php echo Html::a('Advertisements', ['admin', 'route' => 'ForSale','view'=>'for-sale'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Occupancies', ['admin', 'route' => 'Occupancy','view'=>'occupancy'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Tenants', ['admin', 'route' => 'Tenant','view'=>'tenant'], ['class' => '']);  ?>
              <li><?php echo Html::a('Preferences', ['admin', 'route' => 'Preference','view'=>'preference'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Terms', ['admin', 'route' => 'Term','view'=>'term'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Locations', ['admin', 'route' => 'County','view'=>'county'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Users', ['admin', 'route' => 'SysUsers','view'=>'sys-users'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Management', ['admin', 'route' => 'Management','view'=>'management'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Group', ['admin', 'route' => 'Group','view'=>'group'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Lookups', ['admin', 'route' => 'LookupCategory','view'=>'lookup-category'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Blogs', ['admin', 'route' => 'Blog','view'=>'blog'], ['class' => '']);  ?></li>
            </ul>
      </div>
        
        <div class="rightbar col-md-10">
            <!-- Renderpartial properties by default -->
          <?php
            if(!$route){
               $route = 'Property';
               $view = 'property';
            }
            $search = '\app\models\\'.$route.'Search';
            $searchModel = new $search;
            $dataProvider = $searchModel->search(Yii::$app->request->get());
            
           echo Yii::$app->controller->renderPartial("../$view/index", [
                'dataProvider' => $dataProvider,
               'searchModel' => $searchModel,
           ]); 
            
            
            
            ?>
      </div>
    </div>
  <div class="panel-footer" id="footerpanel">
      Panel Footer
       <div class="modal fade" id="modal_id" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" id="modal_title_div">Real Estate</h4>
                </div>
                <div class="modal-body" id="modal_body_div">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
  </div>
</div>


<?php
/* $heredoc = <<<HEREDOC
        $('.load_data').click(function(){
        $.ajax({
        url: "/realestate/web/index.php/site/load-data",
        data: {string:this.id}
      }).success(function(data) { 
        $( this ).addClass( "done" );
        $('.rightbar').html(data.div);
      });
    });
HEREDOC;
$this->registerJs($heredoc, View::POS_END, 'my-options');  */
$this->registerJsFile(\Yii::$app->request->BaseUrl.'/js/jsLib.js', ['depends' => [\yii\web\JqueryAsset::className()]]);  

$heredoc2 = <<<HEREDOC
       $('#modal').removeAttr('modal_id');
HEREDOC;
$this->registerJs($heredoc2, View::POS_END, 'my-options');  

?>


