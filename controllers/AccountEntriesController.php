<?php

namespace app\controllers;

use Yii;
use app\models\AccountEntries;
use app\models\AccountEntriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\utilities\DataHelper;
use yii\web\Response;

/**
 * AccountEntriesController implements the CRUD actions for AccountEntries model.
 */
class AccountEntriesController extends Controller
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
     * Lists all AccountEntries models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountEntriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	 public function actionTransfer(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new AccountEntries();
		

        if ($model->load(Yii::$app->request->post()) && $model->transferValidations() ) {
            
           if($model->transfer()){
               return array(
                    'status'=>'success', 
                    'message'=>'Successfully saved.',
                    'div'=>"Successfully saved!",
                    'gridid'=>'pjax-account-entries',
                    'alert_div'=>'account-entries-form-alert'
                    );
           }
           
        } 
	 $form = $this->renderAjax('transfer', ['model' => $model]);
			
	    return array(
                    'status'=>'error', 
                    'message'=>'Please fix below errors!.',
                    'div'=>$form,
                    'gridid'=>'pjax-account-entries',
                    'alert_div'=>'account-entries-form-alert'
                    );
    }
	

    /**
     * Displays a single AccountEntries model.
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
     * Creates a new AccountEntries model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccountEntries();
        $dh = new DataHelper;
        $keyword = 'account-entries';

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
     * Updates an existing AccountEntries model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dh = new DataHelper;
        $keyword = 'account-entries';

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
     * Deletes an existing AccountEntries model.
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
     * Finds the AccountEntries model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccountEntries the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccountEntries::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDailySummary()
    {
        if(\yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        if(($type = Yii::$app->request->post('id')) !== null) {
            switch($type)
            {
                case 1: 
                    $query = AccountEntries::getEntrieQuery(date('Y-m-d'), 1101, true);
                    $payments = $query->all();
                    $dataProvider = new \yii\data\ActiveDataProvider(['query'=>$query]);
                            
                    $dataProvider->pagination->pageSize=100;
                    return $this->render('partials/cash_summary', [
                        'dataProvider' => $dataProvider,
                    ]);
                    
                case 2:
                    $query = AccountEntries::getEntrieQuery(date('Y-m-d'), 1105, true);
                    $bills = $query->all();
                    $dataProvider = new \yii\data\ActiveDataProvider([
                        'query' => \app\models\OccupancyRent::find()->where(['in', 'id', array_column($bills, 'origin_id')]),
                    ]);
                    $dataProvider->pagination->pageSize=100;
                    return $this->render('partials/rent_summary', [
                        'dataProvider' => $dataProvider,
                    ]);
                    
              /*  case 3:
                    $query = AccountEntries::getEntrieQuery(date('Y-m-d'), 1106, true);
                    $penalities = $query->all();
                    $dataProvider = new \yii\data\ActiveDataProvider([
                        'query' => \app\models\OccupancyRent::find()->where(['in', 'id', array_column($penalities, 'origin_id')]),
                    ]);
                    return $this->render('partials/penalties_summary', [
                        'dataProvider' => $dataProvider,
                    ]);
               * 
               */
                    
                case 4:
                    $query = AccountEntries::getEntrieQuery(date('Y-m-d'), 1107, true);
                    $disbursements = $query->all();
                    $dataProvider = new \yii\data\ActiveDataProvider([
                        'query' => \app\models\Disbursements::find()->where(['in', 'id', array_column($disbursements, 'origin_id')]),
                    ]);
                    return $this->render('partials/disbursement_summary', [
                        'dataProvider' => $dataProvider,
                    ]);
            }
        }
    }
}
