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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
	<?php
        $dh = new DataHelper();
						 $url=Url::to(['landlord-imprest/create']);
                       echo $dh->getModalButton(new LandlordImprest, 'landlord-imprest/create', 'New LandLord Imprest', 'btn btn-danger btn-create btn-new pull-right' , "Create landlord Imprest",$url);
               ?>
  
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'fk_landlord',
                'value'=>'fkLandlord.name1'                
            ],
            //'fk_landlord',
            'amount',
            'entry_date',
            // 'created_on',
            // 'created_by',
            [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'attribute' => '_status',
            'filter' => app\models\Lookup::getLookupValues('Imprest Status'),
            'value' => function ($data) {
                $category_id = \app\models\LookupCategory::getLookupCategoryID('Imprest Status');
                return app\models\Lookup::getLookupCategoryValue($category_id, $data->_status);
            },
         ],
             //'_status',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
