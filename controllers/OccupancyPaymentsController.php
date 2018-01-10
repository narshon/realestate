<?php

namespace app\controllers;

use Yii;
use app\models\OccupancyPayments;
use app\models\OccupancyPaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * OccupancyPaymentsController implements the CRUD actions for OccupancyPayments model.
 */
class OccupancyPaymentsController extends Controller
{
    public $settled_bills = [];
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
     * Lists all OccupancyPayments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OccupancyPaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OccupancyPayments model.
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
     * Creates a new OccupancyPayments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if(($occupany = \app\models\Occupancy::findOne($id)) !== null) {
            $model = new OccupancyPayments();
            $model->fk_occupancy_id = $occupany->id;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //$model->postJournal();
                if(\Yii::$app->request->isAjax) {
                    return $this->renderAjax('receipt',[
                        'model' => $model,
                    ]);
                }else{
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }elseif(\Yii::$app->request->isAjax) {
                return $this->renderAjax('create', [
                   'model' => $model, 
                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else {
            throw new NotFoundHttpException('Occupancy Not Found');
        }
        
    }

    /**
     * Updates an existing OccupancyPayments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(\Yii::$app->request->isAjax) {
                    return $this->renderAjax('receipt',[
                        'model' => $model,
                    ]);
                }else{
                    return $this->redirect(['view', 'id' => $model->id]);
                }
        } elseif(\Yii::$app->request->isAjax) {
                return $this->renderAjax('create', [
                   'model' => $model, 
                ]);
        }  else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OccupancyPayments model.
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
     * Finds the OccupancyPayments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OccupancyPayments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OccupancyPayments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionPrintReceipt($id)
    {
        $model = $this->findModel($id);
        $query = OccupancyPayments::find()->where(['id'=>$model->id]);
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('receipt',[
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('receipt', [
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    
     public function actionOccupancyPayments($id)
    {
        $model = \app\models\Occupancy::findOne($id);
        $searchModel = new OccupancyPaymentsSearch();
        $searchModel->fk_occupancy_id = $model->id;
        // $dataProvider = $searchModel->search(Yii::$app->request->get());
        
        $query = OccupancyPayments::find()->where(['fk_occupancy_id'=>$model->id]);
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        
        return \yii\helpers\Json::encode($this->renderAjax('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'occupancy' => $model
            ]));
    }
    
    public function actionMapPayments($id)
    {
        $model = \app\models\Occupancy::findOne($id);
        $nsettled_bills = \app\models\OccupancyRent::getUnsettledBillList($model->id);
        $model->getUnallocatedPayments();
        if(Yii::$app->request->isPost && Yii::$app->request->post('cleared_bills') !== null) {
            if(!empty($cleared_bills = Yii::$app->request->post('cleared_bills'))){
                $status = \app\models\Lookup::findOne(['_value' => 'Matched', 'category'=>6]);
                $model->clearBills(explode(',', $cleared_bills), $status? $status->_key:1);
                return $this->redirect(Yii::$app->request->referrer);
            }
        } elseif(\yii::$app->request->isAjax) {
            return $this->renderAjax('allocation',[
            'model' => $model,
            'bills' => $nsettled_bills,
        ]);
        } else {
            return $this->render('allocation',[
            'model' => $model,
            'bills' => $nsettled_bills,
        ]);
        }
    }
    
    public function actionGetBillAmount()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if(Yii::$app->request->post('ids') !== null) {
                $ids = Yii::$app->request->post('ids');
                $bills = \app\models\OccupancyRent::find()
                    ->where(['in', 'id', $ids])->all();
                return count($bills) > 0 ? \yii\helpers\ArrayHelper::map($bills, 'id', 'amount') : [];
            }
        }
    }
}
