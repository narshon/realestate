<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use app\models\Blog;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-danger">
      <div class="panel-heading">
          <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="panel-body">
      <div class="blog-index">
            <p>
                <?php 
                      $dh = new DataHelper();
                       echo $dh->getModalButton(new Blog, 'blog/create', 'Blogs', 'btn btn-danger btn-create');
                ?>
            </p>
            <?php Pjax::begin(['id'=>'pjax-blog',]); ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'fk_user_id',
                    'blog_title:ntext',
                    'blog_post:ntext',
                    'posted_date',
                    // '_status',
                    // 'date_created',
                    // 'date_modified',
                    // 'modified_by',
                    // 'created_by',

                    ['class' => 'yii\grid\ActionColumn',
                     'template' => '{view} {update}',
                     'buttons' => [
                                    'view' => function ($url, $model){
                                              $dh = new DataHelper();
                                              $popup = $dh->getModalButton($model, "blog/view", "Blogs", 'glyphicon glyphicon-eye-open','');
                                              return $popup;
                                             
                                    }, 
                                    'update' => function ($url, $model) {
                                             $dh = new DataHelper();
                                             return $dh->getModalButton($model, "blog/update", "Blogs", 'glyphicon glyphicon-edit','');
                                    },
                            ], 
                    ],
                                            
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
      </div>
</div>