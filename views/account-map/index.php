<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Maps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-map-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Account Map', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_term',
            'fk_account_chart',
            'transaction_type',
            'status',
            // 'created_on',
            // 'created_by',
            // 'modified_on',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
