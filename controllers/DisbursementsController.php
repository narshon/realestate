<?php

namespace app\controllers;

use Yii;
use app\models\Disbursements;
use app\models\DisbursementsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DisbursementsController implements the CRUD actions for Disbursements model.
 */
class DisbursementsController extends Controller
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
     * Lists all Disbursements models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisbursementsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Disbursements model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Disbursements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Disbursements();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Disbursements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Disbursements model.
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
     * Finds the Disbursements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Disbursements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disbursements::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPay($owner_id)
    {
        
        //get all the pending disbursements
        $model = new Disbursements();
        $nsettled_bills = \app\models\Disbursements::getUnsettledDisbursementList($owner_id);
        //advances and advance ids
        $model->getPaymentAdvances($owner_id);
        if(Yii::$app->request->isPost && Yii::$app->request->post('cleared_bills') !== null) {
            if(!empty($cleared_bills = Yii::$app->request->post('cleared_bills'))){
                $nsettled_bills = Yii::$app->request->post('bills_pool');
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
              /* //process payments....
                $status = \app\models\Lookup::findOne(['_value' => 'Paid', 'category'=> \app\models\LookupCategory::getLookupCategoryID("Disbursement Status")]);
                Disbursements::clearBills(explode(',', $cleared_bills), $status? $status->_key:1);
                return $this->redirect(Yii::$app->request->referrer); 
               * 
               */
             //present draft statement for confirmation.
              $form = $this->renderAjax('confirmpay',[
                    'model' => $model,
                    'bills' => $nsettled_bills,
                     'cleared_bills' => $cleared_bills,
                    'owner_id' => $owner_id
              ]);
              return array('div'=>$form);
            }
        } elseif(\yii::$app->request->isAjax) {
            return $this->renderAjax('disburse',[
            'model' => $model,
            'bills' => $nsettled_bills,
            'owner_id' => $owner_id
        ]);
        } else {
            return $this->render('disburse',[
            'model' => $model,
            'bills' => $nsettled_bills,
            'owner_id' => $owner_id
        ]);
        }
    }
    
    public function actionMakePayments($owner_id, $cleared_bills, $advance_ids, $total_advance){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //get all the pending disbursements
        $model = new Disbursements();
        
        $feedback = $model->settleDisbursements($owner_id, $cleared_bills, $advance_ids, $total_advance);
        if($feedback == "success"){
           return array('div'=>"<div class='success'> <span> Successfully made disbursements.  <span> </div> ");
        }
        
    }
    
    public function actionGetBillAmount()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if(Yii::$app->request->post('ids') !== null) {
                $ids = Yii::$app->request->post('ids');
                $bill = \app\models\Disbursements::findone($ids);
                   
                return count($bill) > 0 ? $bill->amount : [];
            }
        }
    }
}
