<?php

namespace app\controllers;

use Yii;
use app\models\Journal;
use app\models\JournalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * JournalController implements the CRUD actions for Journal model.
 */
class JournalController extends Controller
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
     * Lists all Journal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JournalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTransfer(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Journal();
		

        if ($model->load(Yii::$app->request->post()) && $model->transferValidations() ) {
            
           if($model->transfer()){
               return array(
                    'status'=>'success', 
                    'message'=>'Successfully saved.',
                    'div'=>"Successfully saved!",
                    'gridid'=>'pjax-journal',
                    'alert_div'=>'journal-form-alert'
                    );
           }
           
        } 
	 $form = $this->renderAjax('transfer', ['model' => $model]);
			
	    return array(
                    'status'=>'error', 
                    'message'=>'Please fix below errors!.',
                    'div'=>$form,
                    'gridid'=>'pjax-journal',
                    'alert_div'=>'journal-form-alert'
                    );
    }

    /**
     * Displays a single Journal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $form = $this->renderAjax('view', ['model' => $this->findModel($id),'id'=>$id],false,false);
            return array(
                'status'=>'success',
                'message'=>'',
                'div'=>$form,
                );
        }
        else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Journal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Journal();
		

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return array(
                    'status'=>'success', 
                    'message'=>'Successfully saved.',
                    'div'=>"Successfully saved!",
                    'gridid'=>'pjax-journal',
                    'alert_div'=>'journal-form-alert-'.$model->id
                    );
        } 
		else {
			
            $form = $this->renderAjax('create', [
                'model' => $model,
            ]);
			
			return array(
                    'status'=>'error', 
                    'message'=>'Please fix below errors!.',
                    'div'=>$form,
                    'gridid'=>'pjax-journal',
                    'alert_div'=>'journal-form-alert-0'
                    );
        }
    }

    /**
     * Updates an existing Journal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
		
         $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			 $form = $this->renderAjax('update', [
                'model' => $model,
            ]);
            return array(
                    'status'=>'success', 
                    'message'=>'Successfully Saved!',
                    'div'=>$form,
                    'gridid'=>'pjax-journal',
                    'alert_div'=>'journal-form-alert-'.$model->id
                    );
        } 
		else {
			
            $form = $this->renderAjax('update', [
                'model' => $model,
            ]);
			
			return array(
                    'status'=>'error', 
                    'message'=>'Please fix the below errors!',
                    'div'=>$form,
                    'gridid'=>'pjax-journal',
                    'alert_div'=>'journal-form-alert-'.$model->id
                    );
        }
    }

    /**
     * Deletes an existing Journal model.
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
     * Finds the Journal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Journal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
