<?php

namespace app\controllers;

use Yii;
use app\models\OccupancyTerm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\utilities\DataHelper;
use yii\web\Response;
use app\models\OccupancyTermSearch;

/**
 * OccupancyTermController implements the CRUD actions for OccupancyTerm model.
 */
class OccupancyTermController extends Controller
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
     * Lists all OccupancyTerm models.
     * @return mixed
     */
    public function actionIndex()
	
    { 
	$searchModel = new OccupancyTermSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    public function actionOccupancyTerms($id)
    {
        $model = \app\models\Occupancy::findOne($id);
        $searchModel = new \app\models\OccupancyTermSearch();
        $searchModel->fk_occupancy_id = $model->id;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        
        return \yii\helpers\Json::encode($this->renderAjax('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]));
    }

    /**
     * Displays a single OccupancyTerm model.
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
     * Creates a new OccupancyTerm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($occupancy_id='')
    {
        $model = new OccupancyTerm();
        $dh = new DataHelper;
        $keyword = 'occupancy-term';
        if($occupancy_id != ''){
            $model->fk_occupancy_id = $occupancy_id;
        }

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
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dh = new DataHelper;
        $keyword = 'occupancy-term';

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
     * Deletes an existing OccupancyTerm model.
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
     * Finds the OccupancyTerm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OccupancyTerm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OccupancyTerm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
