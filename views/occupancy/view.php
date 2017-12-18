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
<div class="col-md-12">
    <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'notes:ntext',
            ],
        ]);
    ?>
</div>
<div class="col-md-12">
    <div class="col-md-6">
        <h3>Occupancy Bills </h3>
        <?php
            $searchModel = new OccupancyRentSearch();
            $searchModel->fk_occupancy_id = $model->id;
            $dataProvider =  $searchModel->search(Yii::$app->request->get());                               //new ActiveDataProvider(['query' => OccupancyRent::getSearchQuery($searchModel,$tenant->id)]);
            echo Yii::$app->controller->renderPartial("../occupancy-rent/index", [
           'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'occupancy'=>$model 
           ]);  
        ?>
    </div>
    
    <div class="col-md-6">
        <h3>Occupancy Terms </h3>
       <?php
            
            $searchModel = new OccupancyTermSearch();
            $searchModel->fk_occupancy_id = $model->id;
            $dataProvider = $searchModel->search(Yii::$app->request->get());
            echo Yii::$app->controller->renderPartial("../occupancy-term/index", [
            'dataProvider' => $dataProvider, 'searchModel' => $searchModel,
            ]);    
        ?>
    </div>
</div>

