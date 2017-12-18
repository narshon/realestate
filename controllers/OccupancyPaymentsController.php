<?php

namespace app\controllers;

use Yii;
use app\models\OccupancyPayments;
use app\models\OccupancyPaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OccupancyPaymentsController implements the CRUD actions for OccupancyPayments model.
 */
class OccupancyPaymentsController extends Controller
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
                    return $this->redirect(['view', 'id' => $model->id]);
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
}
