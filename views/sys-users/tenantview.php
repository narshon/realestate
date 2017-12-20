<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\OccupancyIssueSearch;
use app\utilities\DataHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\SysUsers */

$this->title = 'Tenant: '.$model->getNames();

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
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tenant" role="tab">Tenant Details</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tenantstatus" role="tab">Rent Status</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tenantstatement" role="tab">Tenant Statement</a></li>
				
				
			</ul> 
			</div>
		<div class="rightbar col-md-10">
			<div class="tab-content">
				<div class="tab-pane active" id="tenant" role="tabpanel">
                                    <div class="sys-users-view">

    <p>
        <?php 
            $dh = new DataHelper();
            $url = Url::to(['tenantform','id'=>$model->id]);
            echo $dh->getModalButton($model, "sys-users/landlordform", "Users", 'glyphicon glyphicon-edit pull-right','',$url,'Users');
         ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
               'label' => 'Names',
                'format'=>'raw',
                'value' => $model->getNames(),
            ],
            
            'email:email',
            'phone',
            'address:ntext',
            'date_added',
            'gender',
            'residence',
           
        ],
    ]) ?>

</div>
</div>
        <div class="tab-pane" id="tenantstatus" role="tabpanel">
          <?php
            //show occupancy of this tenant
            $searchModel = new \app\models\OccupancySearch();
            $dataProvider = new ActiveDataProvider(['query' => \app\models\Occupancy::find()->where(['fk_user_id'=> $model->id]),]);
             echo Yii::$app->controller->renderPartial("../occupancy/index", [
                  'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
                  'tenant'=>$model
              ]); ?>
        </div>
        <div class="tab-pane " id="tenantstatement" role="tabpanel">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(); ?>
                <div class="col-md-3"></div>
                <div class="col-md-4">
                  <?= $form->field($model, 'selected_property')->dropdownList(
                        $model->getAllOccupanciesList(),
                        ['prompt'=>'--select occupancy--']); 
                  ?>
                </div>
                <div class="col-md-3"></div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-12 print-statement">
                <div class="container-loader"></div>
                <div class="statement"></div>
            </div>

        </div>
      
	  </div>
	  </div>
</div>
</div>