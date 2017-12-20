<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\utilities\DataHelper;
use app\models\SysUsersSearch;
use yii\web\Response;

/**
 * SysUsersController implements the CRUD actions for SysUsers model.
 */
class SysUsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SysUsers models.
     * @return mixed
     */
    public function actionLandlord()
    {
		
        $searchModel = new SysUsersSearch();
		$searchModel->load(Yii::$app->request->get());
        $dataProvider = new ActiveDataProvider(['query' =>Users::getSearchQuery($searchModel,\app\models\Group::getLandlordID(),Yii::$app->user->identity->fk_management_id)]);
        
        

        return $this->render('landlord', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    /**
     * Lists all SysUsers models.
     * @return mixed
     */
    public function actionTenant()
    {
        $searchModel = new SysUsersSearch();
		$searchModel->load(Yii::$app->request->get());
		 $dataProvider = new ActiveDataProvider(['query' =>Users::getSearchTenant($searchModel,\app\models\Group::getTenantID(),Yii::$app->user->identity->fk_management_id)]);
       
        return $this->render('tenant', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    /**
     * Lists all SysUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
	$searchModel = new SysUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
		
    }
    /**
     * Displays a single SysUsers model.
     * @param integer $id
     * @return mixed
     */
    public function actionLandlordview($id)
    {
        return $this->render('landlordview', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Displays a single SysUsers model.
     * @param integer $id
     * @return mixed
     */
    public function actionTenantview($id)
    {
        return $this->render('tenantview', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * Displays a single SysUsers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $data = $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ],false,false);
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return array(
                'div'=>$data,
                
            );
        }
        else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new SysUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        $dh = new DataHelper;
        $keyword = 'sys-users';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            if (Yii::$app->request->isAjax)
            {
               return $dh->processResponse($this, $model, 'update', 'success', 'Successfully Saved!', 'pjax-'.$keyword, $keyword.'-form-alert-'.$model->id);
               exit;               
            }
            
        } else {
            if (Yii::$app->request->isAjax)
            {
                return $dh->processResponse($this, $model, 'create', 'danger', 'Please fix the below errors!', 'pjax-'.$keyword, $keyword.'-form-alert-0');
               exit; 
                     
            }
            else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
    
    /**
     * Creates a new SysUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionLandlordform($id='')
    {
        if(!$id){
        $model = new Users();
        }
        else{
            $model=$this->findModel($id);
        } 
            
        $dh = new DataHelper;
        $keyword = 'sys-users';
        $model->fk_group_id = \app\models\Group::getLandlordID();
        $model->fk_management_id = Users::getManagementID();
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            if (Yii::$app->request->isAjax)
            {
               return $dh->processResponse($this, $model, 'landlordform', 'success', 'Successfully Saved!', 'pjax-'.$keyword, $keyword.'-form-alert-'.$model->id);
               exit;               
            }
            
        } else {
            if (Yii::$app->request->isAjax)
            {
                return $dh->processResponse($this, $model, 'landlordform', 'danger', 'Please fix the below errors!', 'pjax-'.$keyword, $keyword.'-form-alert-0');
               exit; 
                     
            }
            else{
                return $this->render('landlordform', [
                    'model' => $model,
                ]);
            }
        }
    }
    
    /**
     * Creates a new SysUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTenantform($id='')
    {
        if(!$id){
        $model = new Users();
        }
        else{
            $model=$this->findModel($id);
        } 
            
        $dh = new DataHelper;
        $keyword = 'sys-users';
        $model->fk_group_id = \app\models\Group::getTenantID();
        $model->fk_management_id = Users::getManagementID();
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            if (Yii::$app->request->isAjax)
            {
               return $dh->processResponse($this, $model, 'tenantform', 'success', 'Successfully Saved!', 'pjax-'.$keyword, $keyword.'-form-alert-'.$model->id);
               exit;               
            }
            
        } else {
            if (Yii::$app->request->isAjax)
            {
                return $dh->processResponse($this, $model, 'tenantform', 'danger', 'Please fix the below errors!', 'pjax-'.$keyword, $keyword.'-form-alert-0');
               exit; 
                     
            }
            else{
                return $this->render('tenantform', [
                    'model' => $model,
                ]);
            }
        }
    }
    
    public function actionSetoccupanttenantform($fk_sublet_id=''){
        $model = new Users();
        $dh = new DataHelper;
        $keyword = 'sys-users';
        $model->fk_group_id = \app\models\Group::getTenantID();
        $model->fk_management_id = Users::getManagementID();
        if($fk_sublet_id){
            $model->fk_sublet_id = $fk_sublet_id;
        }
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            if (Yii::$app->request->isAjax)
            {
               //show occupancy form now. we have our tenant added.
                Yii::$app->response->format = Response::FORMAT_JSON;
                $occupancy = new \app\models\Occupancy();
                $occupancy->fk_property_id = \app\models\PropertySublet::getPropertyID($model->fk_sublet_id);
                $occupancy->fk_sublet_id = $model->fk_sublet_id;
                $occupancy->fk_user_id = $model->id;
                $form = $this->renderAjax('/occupancy/setform', ['model' => $occupancy],false,false);
                return array(
                            'div'=>$form,
                       );
                              
            }
            
        } else {
            if (Yii::$app->request->isAjax)
            {
                return $dh->processResponse($this, $model, 'tenantform', 'danger', 'Please fix the below errors!', 'pjax-'.$keyword, $keyword.'-form-alert-0');
                     
            }
            else{
                return $this->render('tenantform', [
                    'model' => $model,
                ]);
            }
        }
        
    }

    /**
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dh = new DataHelper;
        $keyword = 'sys-users';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            if (Yii::$app->request->isAjax)
            {   
                return $dh->processResponse($this, $model, 'update', 'success', 'Successfully Saved!', 'pjax-'.$keyword, $keyword.'-form-alert-'.$model->id);                
            }
        } else {
            if (Yii::$app->request->isAjax)
            {
                return $dh->processResponse($this, $model, 'update', 'danger', 'Please fix the below errors!', 'pjax-'.$keyword, $keyword.'-form-alert-'.$model->id);   
            }
            else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing SysUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SysUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SysUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionStatement()
    {
        $data = [];
        if(\yii::$app->request->isPost) {
            if(($id = \yii::$app->request->post('id'))) {
                $model = \app\models\Occupancy::findOne($id);
                $payments = \app\models\OccupancyPayments::findAll(['fk_occupancy_id' => $id, 'status' => 1]);
                $bills = \app\models\OccupancyRent::findAll(['fk_occupancy_id' => $id, '_status' => 1]);
                $data = array_merge($this->normalizeData($payments, 'payments'), $this->normalizeData($bills, 'bills'));
                if(\Yii::$app->request->isAjax) {
                    return \yii\helpers\Json::encode($this->renderAjax('statement', [
                        'model'=> $model,
                        'data'=>$data
                    ]));
                }else{
                    return $this->render('statment', [
                        'model' => $model, 
                        'data'=> $data,
                    ]);
                }              
            }
        }
    }
    private function normalizeData($data, $type)
    {
        switch($type)
        {
            case 'payments':
                $ret = [];
                foreach($data as $item) {
                    $ret[] = ['date' => $item->payment_date, 'category' => 'credit', 'amount' => $item->amount, 'description' => $item->ref_no];
                }
                return $ret;
            case 'bills':
                $ret = [];
                foreach($data as $item) {
                    $ret[] = ['date' => $item->date_created, 'category' => 'debit', 'amount' => $item->amount, 'description' => $item->fkTerm->term_name];
                }
                return $ret;
        }
    }
}
