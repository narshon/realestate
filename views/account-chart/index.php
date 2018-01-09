<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountChartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Charts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-chart-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Account Chart', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            'fk_re_account_type',
            'status',
            // 'description:ntext',
            // 'created_by',
            // 'modified_by',
            // 'created_on',
            // 'modified_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
