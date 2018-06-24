<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\OccupancyIssueSearch;
use app\utilities\DataHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use app\models\Users;

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
            <?php
               echo Users::getTenantTabs($model->id);
            ?>
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
    <?php Pjax::begin(['id'=>'pjax-tenant-view-details',]); ?> 
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
            'occupation',
            'employer',
           
        ],
    ]) ?>
    <?php Pjax::end(); ?>
    
</div>
</div>
        <div class="tab-pane" id="tenantstatus" role="tabpanel">
          <?php
            //show occupancy of this tenant
            $searchModel = new \app\models\OccupancySearch();
            $dataProvider = new ActiveDataProvider(['query' => \app\models\Occupancy::find()->where(['fk_user_id'=> $model->id])->orderBy("id desc"),]);
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