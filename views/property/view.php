<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $model app\models\Property */

$this->title = "Property: ".$model->property_name;
?>
<?php

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
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
	  <div class="leftbar col-md-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#property" role="tab">Property Details</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sublet" role="tab">Sublets</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#feature" role="tab">Features</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#term" role="tab">Terms</a></li>
				
				
			</ul> 
			</div>
		<div class="rightbar col-md-10">
			<div class="tab-content">
				<div class="tab-pane active" id="property" role="tabpanel">
             <div class="property-view">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                      // 'id',
                       'property_name',
                       'property_desc',
                        [
                            'label' => 'Estate',
                             'format'=>'raw',
                             'value' => $model->getEstate(),
                         ],
                        
                        [
                            'label' => 'Property Type',
                             'format'=>'raw',
                             'value' => app\models\Lookup::getLookupCategoryValue(app\models\LookupCategory::getLookupCategoryID("Property Type"), $model->property_type),
                         ],
                       
                 
                         [
                            'label' => 'Agency',
                             'format'=>'raw',
                             'value' => isset($model->management->management_name)?$model->management->management_name:"",
                         ],
                        [
                            'label' => 'owner_id',
                             'format'=>'raw',
                             'value' =>isset($model->owner->getNames)?$model->owner->getNames():"",
							 
                         ],
                       
                        'property_video_url',
                         [
                            'label' =>  '_status',
                             'format'=>'raw',
                             'value' => $model->getStatus(),
                         ],
                       
                          
                    ],
                ]) ?>

            </div>
</div>
        <div class="tab-pane" id="sublet" role="tabpanel">
          <?php
            //show properties of this landlord.
            $searchModel = new \app\models\PropertySubletSearch();
            $dataProvider = new ActiveDataProvider(['query' => \app\models\PropertySublet::find()->where(['fk_property_id'=> $model->id])]);
             echo Yii::$app->controller->renderPartial("../property-sublet/index", [
                  'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
                  'property'=>$model
              ]); ?>
        </div>
            <div class="tab-pane " id="feature" role="tabpanel">
                <?php
                    //show properties of this landlord.
                    $searchModel = new \app\models\PropertyFeatureSearch();
                    $dataProvider = new ActiveDataProvider(['query' => \app\models\PropertyFeature::find()->where(['fk_property_id'=> $model->id])]);
                     echo Yii::$app->controller->renderPartial("../property-feature/index", [
                          'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
                          'property'=>$model
                      ]); 
                ?>
            </div>
            <div class="tab-pane " id="term" role="tabpanel">
                <?php
                    //show properties of this landlord.
                    $searchModel = new \app\models\PropertyTermSearch();
                    $dataProvider = new ActiveDataProvider(['query' => \app\models\PropertyTerm::find()->where(['fk_property_id'=> $model->id])]);
                     echo Yii::$app->controller->renderPartial("../property-term/index", [
                          'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
                          'property'=>$model
                      ]); 
                ?>
            </div>
	  </div>
	  </div>
</div>
</div>

