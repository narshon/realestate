<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LandlordImprestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Landlord Imprests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="landlord-imprest-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Landlord Imprest', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_landlord',
            'amount',
            'entry_date',
            // 'created_on',
            // 'created_by',
             '_status',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
