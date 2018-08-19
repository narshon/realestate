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
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new AccountEntries();
        $dh = new DataHelper;
        $keyword = 'account-entries';
        
              
        if ($model->load(Yii::$app->request->post()) && $model->validateExpenses()) {
            //return $this->redirect(['view', 'id' => $model->id]);
           
               
               if($model->updateExpenseAccounts()){
                return array(
                     'status'=>'success', 
                     'div'=>"Successfully posted entry",

                   );
 
              }
              else{
                  return array(
                     'status'=>'error', 
                     'div'=>"Oops! an error occured!",

                   );
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
        $account_id = Yii::$app->request->post('id');
        $report_type = Yii::$app->request->post('report_type');
        if(\yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        if( $account_id !== null) {
          return  $this->getAssetsReport($account_id, $report_type);  
        }
    }
    public function actionAccountStatement($string){
        
        if(\yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        if($string){
            $query = AccountEntries::find()->where(['fk_account_chart'=>$string, 'origin_model'=>"app\models\OccupancyPayments"])->orderBy("id DESC");
            $dataProvider = new \yii\data\ActiveDataProvider(['query'=>$query]);

            $dataProvider->pagination->pageSize=100;
            if(\yii::$app->request->isAjax) {
            $view = $this->render('partials/account_report', [
                'dataProvider' => $dataProvider, 'account'=> \app\models\AccountChart::findOne(['id'=>$string])
            ],false,false);
            }
            else{
              return  $this->render('partials/account_report', [
                'dataProvider' => $dataProvider, 'account'=> \app\models\AccountChart::findOne(['id'=>$string])
            ]);
            }
            
            return array(
                     'status'=>'success', 
                     'div'=>$view,

                   );
        }
    }
    
    public function actionPending()
    {
        $searchModel = new \app\models\OccupancyRentSearch();
        $query = \app\models\OccupancyRent::find()->where(['_status'=>0]);
        $dataProvider = new \yii\data\ActiveDataProvider(['query'=>$query]);    // $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionTrial()
    {
        $searchModel = new AccountEntriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('trial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIereport()
    {
        $searchModel = new AccountEntriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('iereport', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionMonthly()
    {
        
        return $this->render('monthly');
    }
    public function actionMonthlyReport($string){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $range = explode("_", $string);
        $date1 = date("Y-m-d", strtotime($range[0]));
        $date2 = date("Y-m-d", strtotime($range[1]));
        $account_no = $range[2];
        
        $query = AccountEntries::find()->where("(entry_date between '$date1' and '$date2') AND fk_account_chart = $account_no ")->groupBy("entry_date")->orderBy("id DESC")->all();
        //$dataProvider = new \yii\data\ActiveDataProvider(['query'=>$query]);
        $view = $this->render('partials/monthly_report', [
                'query' => $query, 'account'=>\app\models\AccountChart::findone($account_no), 'date1'=>$date1, 'date2'=>$date2
            ]);
        return array(
                     'status'=>'success', 
                     'div'=>$view,
                   );
    }
    
    public function getAssetsReport($account_id, $report_type){
        
       $query = AccountEntries::getEntrieQuery(date('Y-m-d'), $account_id, true);
       $payments = $query->andwhere(['trasaction_type'=>'debit'])->orderBy("id DESC")->all();
      return $this->renderPartial('partials/cash_summary', [ 'transactions' => $payments, 'account'=> \app\models\AccountChart::findOne(['id'=>$account_id]),'report_type'=>$report_type]);
    }
    
    public function actionAccountReport($string){
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $range = explode("_", $string);
        $date1 = date("Y-m-d", strtotime($range[0]));
        $date2 = date("Y-m-d", strtotime($range[1]));
        $account_no = $range[2];
        
        $query = AccountEntries::find()->where("(entry_date between '$date1' and '$date2') AND fk_account_chart = $account_no ")->groupBy("entry_date")->orderBy("id DESC")->all();
        //$dataProvider = new \yii\data\ActiveDataProvider(['query'=>$query]);
        $view = $this->render('partials/monthly_report', [
                'query' => $query, 'account'=>\app\models\AccountChart::findone($account_no), 'date1'=>$date1, 'date2'=>$date2
            ]); 
        return array(
                     'status'=>'success', 
                     'div'=>$view,
                   );
    }
    
}
