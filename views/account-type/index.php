<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Account Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'Description',
            'created_by',
            'modified_by',
            // 'created_on',
            // 'modified_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
