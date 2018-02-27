<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SysUsers */

$this->title = $model->getNames();
$this->params['breadcrumbs'][] = ['label' => 'Sys Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-users-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
              'label'=>'Group',
              'format'=>'raw',
              'value'=>$model->fkGroup->group_name  
            ],
            'username',
           // 'pass',
            'name1',
            'name2',
            'name3',
            'age',
            'email:email',
            'phone',
            'address:ntext',
            'date_added',
            'gender',
           // 'color_code',
           // 'icon_id',
        ],
    ]) ?>

</div>
