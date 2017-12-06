<?php

namespace app\controllers;

use Yii;
use app\models\Accounts;
use app\models\AccountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * AccountsController implements the CRUD actions for accounts model.
 */
class AccountsController extends Controller
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
     * Lists all accounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single accounts model.
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
     * Creates a new accounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		 Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Accounts();
		

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return array(
                    'status'=>'success', 
                    'message'=>'Successfully saved.',
                    'div'=>"Successfully saved!",
                    'gridid'=>'pjax-accounts',
                    'alert_div'=>'accounts-form-alert-'.$model->id
                    );
        } 
		else {
			
            $form = $this->renderAjax('create', [
                'model' => $model,
            ]);
			
			return array(
                    'status'=>'error', 
                    'message'=>'Please fix the below errors!',
                    'div'=>$form,
                    'gridid'=>'pjax-accounts',
                    'alert_div'=>'accounts-form-alert-0'
                    );
        }
        
    }

    /**
     * Updates an existing accounts model.
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
                    'gridid'=>'pjax-accounts',
                    'alert_div'=>'accounts-form-alert-'.$model->id
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
                    'gridid'=>'pjax-accounts',
                    'alert_div'=>'accounts-form-alert-'.$model->id
                    );
        }
       
    }

    /**
     * Deletes an existing accounts model.
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
     * Finds the accounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return accounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accounts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
