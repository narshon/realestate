<?php
use yii\web\View;
use app\models\Property;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use app\models\County;
use app\models\Group;
use app\models\Lookups;
use app\models\OccupancyIssueSearch;
use yii\helpers\Url;
use yii\bootstrap\Button;



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
<?php echo \app\models\Management::getAgentTitle() ?>


<div class="panel panel-default">
    
    <div class="panel-body">
        
     <div class="rightbar col-md-12">
            <!-- Renderpartial properties by default -->
			<?php 
			   $propertylink = Url::to(['property/index']);
			   $managementlink = Url::to(['sys-users/landlord']);
			   $tenantlink = Url::to(['sys-users/tenant']);
			   $journallink = Url::to(['account-entries/index']);
			   
			?>
		<div class="tab-content">
			  <div class="tab-pane active" id="dashboard" role="tabpanel">
					<div class=" col-md-12">
						<div class=" col-md-6"><a href="<?=$propertylink ?>"<button type="button" class="btn btn-danger btn-lg btn-d">Properties</button></a></div>
						<div class=" col-md-6"><a href="<?=$managementlink?>"<button type="button" class="btn btn-info btn-lg btn-d">Landlords</button></a></div>
					</div>
					<div class=" col-md-12">
						<div class=" col-md-6"><a href="<?=$tenantlink?>"<button type="button" class="btn btn-primary btn-lg btn-d">Tenants</button></a> </div>
						<div class=" col-md-6"><a href="<?=$journallink?>"<button type="button" class="btn btn-success btn-lg btn-d">Finance</button></a></div>
					</div>	  
			  </div>
			  <div class="tab-pane" id="issues" role="tabpanel">
			  <?php
			  
			 /* Public static getIssue function{
			  $all = OccupancyIssue::find()->all();
			  if($model=>occupancy_id){
				  
				  return &all; 
			  }
			  }*/
		
             $searchModel = new OccupancyIssueSearch();
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-issue/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);  ?>
			  
			  
			  </div>
			  <div class="tab-pane" id="rent" role="tabpanel">...e4</div>
			  <div class="tab-pane" id="daily" role="tabpanel">...</div>
			  <div class="tab-pane" id="monthly" role="tabpanel">...e4</div>
			  <div class="tab-pane" id="trial" role="tabpanel">..444.</div>
		</div>
          
      </div>
    </div>
  <div class="panel-footer" id="footerpanel">
      
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


