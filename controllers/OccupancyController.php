<?php

namespace app\controllers;

use Yii;
use app\models\Occupancy;
use app\models\OccupancySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\utilities\DataHelper;
use yii\web\Response;
use yii\helpers\Url;

/**
 * OccupancyController implements the CRUD actions for Occupancy model.
 */
class OccupancyController extends Controller
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
    
    
    public function actionTenant($property_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
      $searchModel = new OccupancySearch();
      $dataProvider = new ActiveDataProvider(['query' => \app\models\Occupancy::find()->where(['fk_property_id'=> $property_id]),]);
     // $dataProvider = $searchModel->search(Yii::$app->request->get());
        

        $data = $this->render('tenant', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'property_id' => $property_id
        ]);
        
        return array(
                    'div'=>$data,
            );
    }

    /**
     * Lists all Occupancy models.
     * @return mixed
     */
    public function actionIndex()
    {
      $searchModel = new OccupancySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    public function actionDisburse(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        //Run billing script for all occupancies based on their terms.
        if($data = Occupancy::calculateDisbursements()){
            
            return array(
                'div'=>$data,
                
            );
        }
        else{
            return array(
                'div'=>"Failed!",
                
            );
        }
    }
    public function actionCalculate(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        //Run billing script for all occupancies based on their terms.
        if($data = Occupancy::calculateBills()){
            
            return array(
                'div'=>$data,
                
            );
        }
        else{
            return array(
                'div'=>"Failed!",
                
            );
        }
    }

    /**
     * Displays a single Occupancy model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $data = $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ],false,false);
            
            
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
    
     public function actionSet($fk_sublet_id)
    {
        
        $model = new Occupancy();
        $dh = new DataHelper;
        $keyword = 'occupancy';
        if(isset($fk_sublet_id)){
            $model->fk_sublet_id  = $fk_sublet_id;
        }

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            //search tenant
            $searchModel = new \app\models\SysUsersSearch();
            $dataProvider = new ActiveDataProvider(['query' => \app\models\Users::find()->where($model->getFindTenantQueryString())]);
            //render tenant grid view
            $grid = $this->renderAjax('findtenantgrid', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'fk_sublet_id'=>$fk_sublet_id,'querystring'=>$model->getFindTenantQueryString()],false,false);
            
            return array('div'=>$grid);
        } else {
            
            //show find tenant form.
            return $dh->processResponse($this, $model, 'findtenant', 'danger', 'Please fix the below errors!', 'pjax-'.$keyword, $keyword.'-form-alert-0');
           
        }
    }
     public function actionSetform($fk_sublet_id='',$fk_user_id='')
    {
        
        $model = new Occupancy();
        $dh = new DataHelper;
        $keyword = 'occupancy';
        if(isset($fk_user_id)){
            $model->fk_user_id  = $fk_user_id;
        }
        if(isset($fk_sublet_id)){
            $model->fk_sublet_id  = $fk_sublet_id;
            $model->fk_property_id = \app\models\PropertySublet::getPropertyID($fk_sublet_id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            if (Yii::$app->request->isAjax)
            { 
                Yii::$app->response->format = Response::FORMAT_JSON;
               //successfully created occupancy, let's redirect to tenant profile.
                $url = Url::to(['sys-users/tenantview','id'=>$model->fk_user_id]);
                return array(
                            'div'=>"Successfully assigned sublet to tenant. Redirecting..."
                    . "<script type='text/javascript'> redirectTo('$url'); </script>",
                 );
               exit;               
            }
            
        } else {
            if (Yii::$app->request->isAjax)
            {
                return $dh->processResponse($this, $model, 'setform', 'danger', 'Please fix the below errors!', 'pjax-'.$keyword, $keyword.'-form-alert-0');
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
     * Creates a new Occupancy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($fk_user_id='')
    {
        
        $model = new Occupancy();
        $dh = new DataHelper;
        $keyword = 'occupancy';
        if(isset($fk_user_id)){
            $model->fk_user_id  = $fk_user_id;
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
        $keyword = 'occupancy';

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
     * Deletes an existing Occupancy model.
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
     * Finds the Occupancy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Occupancy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Occupancy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSublets(){
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $property_key = $parents[0];
                
                $out = \app\models\PropertySublet::getSubletsList($property_key);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    
    }
    
}
