<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OccupancyIssueSearch;
use app\utilities\DataHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Management */

//$this->title = 'agent: '.$model->getNames();
?>


    <p>
        <?php 
            $dh = new DataHelper();
            $url = Url::to(['agentform','id'=>$model->id]);
            echo $dh->getModalButton($model, "../management/agentform", "Users", 'glyphicon glyphicon-edit pull-right','',$url,'Users');
         ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fk_user_id',
            'management_name',
            'management_type',
            'location:ntext',
            'address:ntext',
            'profile_desc:ntext',
            'featured_property',
            'date_created',
            'created_by',
            'date_modified',
            'modified_by',
            '_status',
        ],
    ]) ?>

        
	