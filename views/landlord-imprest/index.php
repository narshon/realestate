<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\LandlordImprest;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LandlordImprestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Landlord Imprests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="landlord-imprest-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
	<?php
        $dh = new DataHelper();
						 $url=Url::to(['landlord-imprest/create']);
                       echo $dh->getModalButton(new LandlordImprest, 'landlord-imprest/create', 'LandlordImprest', 'btn btn-danger btn-create btn-new pull-right' , "Create landlord Imprest",$url);
               ?>
  
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
