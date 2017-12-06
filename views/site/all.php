<?php

$this->title = 'Real Estate Pro';
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use yii\helpers\Html;
use \app\models\Property;
use app\utilities\DataHelper;

$datahelper = new DataHelper();
$session = Yii::$app->session;
//get the session search params.
$search = $session->get('search');



?>

<div class="panel panel-danger">
        <div class="panel-heading">Search Filters: <?= print_r($search,true); ?></div>
            <div class="panel-body">
	     <div class="row">
                  <?php 
                  $criteria = $datahelper->getSearchCriteria($search);
                  $query = Property::find()->where($criteria);
                    $dataProvider = new ActiveDataProvider([
                         'query' => $query,
                        'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
                     ]);
                    $dataProvider->pagination->pageSize=12;
                   echo  ListView::widget([
                             'dataProvider' => $dataProvider,
                             'itemOptions' => ['class' => 'item col-lg-3'],
                             'itemView' => function ($model, $key, $index, $widget) {
                                     return $model->propertyPost();
                             },
                     ]); 
                ?>     

              </div>
            </div>  
        </div>