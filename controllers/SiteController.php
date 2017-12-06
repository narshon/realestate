<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use app\models\PropertyArea;
use yii\web\Response;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionUpload(){
        
        $tmp_name = $_FILES['propertyfeatureimage-image_url']["tmp_name"];   
        $temp = $_FILES["propertyfeatureimage-image_url"]["name"];
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        if(move_uploaded_file($tmp_name, "uploads/$temp")){
            return array(
            'div'=>"<span class='success'> Uploaded Successfully </span>",
             'val'=>$temp
            );
        }
        else{
            return array(
            'div'=>"Oops! An Error Occured",
            );
        }
       
    }
    public function actionAll()
    {
        return $this->render('all');
    }
    public function actionMaisonetts()
    {
        return $this->render('maisonetts');
    }
    public function actionBedsitter()
    {
        return $this->render('bedsitter');
    }
    public function actionHostel()
    {
        return $this->render('hostel');
    }
    public function actionSingle()
    {
        return $this->render('single');
    }
    public function actionOnebr()
    {
        return $this->render('onebr');
    }
    public function actionTwobr()
    {
        return $this->render('twobr');
    }
    public function actionLodging()
    {
        return $this->render('lodging');
    }
    public function actionAgents()
    {
        return $this->render('agents');
    }
    
    
    public function actionRent()
    {
        return $this->render('rent');
    }
    
    public function actionBuy()
    {
        return $this->render('buy');
    }
    
    public function actionShamba()
    {
        return $this->render('shamba');
    }
    
    public function actionUpdateData($model_name, $model_id, $view_file){
        
        $model = 'app\models\\'.$model_name;
        if($model){
            if($model_id)
             $model = $model::findOne($model_id);
            else
              $model = new $model;
            
            $data = $this->renderAjax('../'.$view_file, [
            'model' => $model,
        ]);
            
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return array(
                    'div'=>$data,
            );
            
        }
        
    }
    public function actionLoadData($string=''){
        
        $stringArray = explode('__', $string);
        $model = 'app\models\\'.$stringArray[0];
        $search = 'app\models\\'.$stringArray[0].'Search';
                
        $searchModel = new $search;
        $dataProvider = $searchModel->search(Yii::$app->request->get());   //
       /* $dataProvider = new ActiveDataProvider([
                   'query' => $model::find(),]);      */
        
        $viewfolder = $stringArray[1];
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $data = $this->renderPartial("../$viewfolder/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);
        return array(
            'div'=>$data,
            );
    }
    public function actionAdmin($route='', $view='')
    {
        return $this->render('admin', ['route'=>$route, 'view'=>$view]);
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
