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
use kartik\tabs\TabsX;
use yii\helpers\Url;

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
    <?= TabsX::widget([
        'containerOptions'=>[
             'class'=>'row',
        ],
        'position'=> TabsX::POS_ABOVE,
        'align'=> TabsX::ALIGN_LEFT,
        'bordered' => true,
        'pluginOptions'=>[
            'enableCache'=>false,
        ],
        'height' => '600px',
        //'enableStickyTabs'=> false,
        //'ajaxSettings'=>[],
        'pluginEvents'=>[],
        'items'=> [
            [
                'label' => 'Occupancy Bills',
                'active' => true,
              //  'content' =>$this->render('occupancy-rent/occupancy-bills', ['id'=>$model->id]),
                'linkOptions' => ['id'=>'bills'.rand(1, 1984),'data-url'=>Url::to(['occupancy-rent/occupancy-bills', 'id'=>$model->id])],
                'data-loading-class' => 'loading-content'
            ],
            [
                'label' => 'Occupancy Payments',
                'linkOptions' => ['id'=>'payments'.rand(1, 1984),'data-url'=>Url::to(['occupancy-payments/occupancy-payments', 'id'=>$model->id])],
                'data-loading-class' => 'loading-content'
            ],
            [
                'label' => 'Occupancy Terms',
                'linkOptions' => ['id'=>'terms'.rand(1, 1984),'data-url'=>Url::to(['occupancy-term/occupancy-terms', 'id'=>$model->id])],
                'data-loading-class' => 'loading-content'
            ],
        ],
    ]);?>
    
</div>

