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
               background: #F0AD4E; /* #B5121B;  */
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
<div class='admin-section-title'><h3> Welcome  <?= Yii::$app->user->identity->username ?> </h3> </div>


<div class="panel panel-default">
    
    <div class="panel-body">
         <div class="leftbar col-md-2">
            <ul class="nav nav-pills nav-stacked">
              <li><?php echo Html::a('Events You\'re Attending', ['profile', 'route' => 'Event','view'=>'event'], ['class' => '']);  ?></li>
              <li><?php echo Html::a('Messages', ['profile', 'route' => 'Notification','view'=>'notification'], ['class' => '']);  ?></li>  <!-- <a href="#feature" id="Feature__feature" class="load_data">  </a> -->
              <li><?php echo Html::a('Account Settings', ['profile', 'route' => 'SysUsers','view'=>'sys-users'], ['class' => '']);  ?></li>
              
            </ul>
      </div>
        
        <div class="rightbar col-md-10">
            <!-- Renderpartial properties by default -->
          <?php
            if((!$route) || $route =='Event'){
               $route = 'Event';
               $view = 'event';
               $search = '\app\models\\'.$route.'Search';
               $searchModel = new $search;
               //get events ids of this user
               $event_ids = app\models\EventParticipant::getUserEventsIds(Yii::$app->user->identity->id);
               if(!$event_ids){ $event_ids = 0; }
               $dataProvider = $searchModel->search([$searchModel->formName() => ['event_ids'=>$event_ids]]); //Yii::$app->user->identity->fk_organizer
               echo Yii::$app->controller->renderPartial("../$view/index", [
                    'dataProvider' => $dataProvider,
                   'searchModel' => $searchModel,
                    ]); 
               
            }
            else{
                $search = '\app\models\\'.$route.'Search';
                $searchModel = new $search;
                if($route == "Notification"){
                    $dataProvider = $searchModel->search([$searchModel->formName() => ['my_messages'=>true]]);
                    echo Yii::$app->controller->renderPartial("../$view/index", [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                        'context'=>'profile'
                   ]); 
                }
                else if($route == "SysUsers"){
                    //$dataProvider = $searchModel->search([$searchModel->formName() => ['sys_users.id'=>Yii::$app->user->identity->id]]);
                    echo Yii::$app->controller->renderPartial("../$view/view", [
                        'model' => Yii::$app->user->identity,
                   ]); 
                }
                else{
                   $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                }
            }
            
            ?>
      </div>
    </div>
  <div class="panel-footer" id="footerpanel">
      Panel Footer
       
  </div>
</div>


<?php

$heredoc2 = <<<HEREDOC
       $('#modal').removeAttr('modal_id');
HEREDOC;
$this->registerJs($heredoc2, View::POS_END, 'my-options');  

?>


