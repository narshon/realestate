<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use app\models\Feature;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Features';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-danger">
      <div class="panel-heading">
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
          <div class="feature-index">

            

            <p>
                <?php 
			$dh = new DataHelper();
			$url=Url::to(['feature/create']);
                       echo $dh->getModalButton(new Feature, 'feature/create', 'Feature', 'btn btn-danger btn-create',"New",$url,"Feature");
                    ?>
           
            </p>
            <?php Pjax::begin(['id'=>'pjax-feature', 'timeout' => 5000]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'feature_name',
                    'feature_desc:ntext',
                    //'created_by',
                    //'date_created',
                    // 'modified_by',
                    // 'date_modified',
                    
                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                             $dh = new DataHelper();
                                             $url = Url::to(['feature/view', 'id'=>$model->id]);
                                              $popup = $dh->getModalButton($model, "feature/view", "Features", 'glyphicon glyphicon-eye-open','',$url);
                                              return $popup;
                                    }, 
                                    'update' => function ($url, $model, $keyword) {
                                            $dh = new DataHelper();
                                            $url = Url::to(['feature/update', 'id'=>$model->id]);
                                           return $dh->getModalButton($model, "feature/update", "Features", 'glyphicon glyphicon-edit','',$url);
                                     },
                            ], 
                    ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
        </div>
      </div>
</div>

