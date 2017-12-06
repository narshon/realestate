<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OccupancyIssue;
use app\models\OccupancyRent;
use app\models\OccupancyTerm;
use app\models\OccupancyIssueSearch;
use app\models\OccupancyRentSearch;
use app\models\OccupancyTermSearch;
use app\models\OccupancySearch;

/* @var $this yii\web\View */
/* @var $model app\models\Occupancy */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Occupancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occupancy-view">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
          
            'notes:ntext',
           
        ],
    ]);
?>
    <h3>Rent Collections </h3>
    <?php
             
             $searchModel = new OccupancyRentSearch();
             $searchModel->fk_occupancy_id = $model->id;
             $dataProvider =  $searchModel->search(Yii::$app->request->get());                               //new ActiveDataProvider(['query' => OccupancyRent::getSearchQuery($searchModel,$tenant->id)]);
            echo Yii::$app->controller->renderPartial("../occupancy-rent/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'occupancy'=>$model 
        ]);  ?>
    
    <h3>Occupancy Terms </h3>
       <?php
            
             $searchModel = new OccupancyTermSearch();
             $searchModel->fk_occupancy_id = $model->id;
             $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-term/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
        ]);    ?>

</div>
