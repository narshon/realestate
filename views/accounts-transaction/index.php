<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\AccountsTransaction;
use yii\widgets\Pjax;
use app\models\Journal;
use app\models\Source;
use app\models\Accounts;
use kartik\widgets\Select2;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountsTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-transaction-index panel panel-danger admin-content">

     <div class="panel-heading">
        <h1>Financial Records</h1>
    </div>
    <div class="panel-body">
	 <ul class=" nav nav-pills nav-stacked">
             <?php  echo Journal::showButtons();  ?>
         </ul>
        <h1><?= Html::encode($this->title) ?></h1>
 <?php Pjax::begin(['id'=>'pjax-accounts-transaction',]); 
    
        
        $columns = [
            'id',
            [
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'attribute' => 'date',
		'filter'=>true,
                'header'=>'Date',
                'value'=>function ($data) {
                            return isset($data->fkJournal->date)?$data->fkJournal->date:"";
                        },
          
            ],
            [
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'attribute' => 'fk_receipt',
		'filter'=>true,
                'header'=>'Receipt/Invoice',
                'value'=>function ($data) {
                            return isset($data->fkJournal->receipt_invoice_no)?$data->fkJournal->receipt_invoice_no:"";
                        },
          
            ],
            [
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'attribute' =>  'fk_account',
		'filter'=>Accounts::getAccountOptions(),
                'header'=>'Account',
                'value'=>function ($data) {
                            return isset($data->fkAccount->account_name)?$data->fkAccount->account_name:"";
                        },
          
            ],
           [
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'attribute' =>  'fk_source',
				'filter'=>true,
                'header'=>'Type',
                'value'=>function ($data) {
                            return isset($data->fkSource->source_name)?$data->fkSource->source_name:"";
                        },
          
            ],
            [
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'attribute' =>  'dr',
		'filter'=>true,
                'header'=>'Dr',
                'value'=>function ($data) {
                            return isset($data->dr)?$data->dr:"";
                        },
          
            ],
            [
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'attribute' =>  'cr',
		'filter'=>true,
                'header'=>'Cr',
                'value'=>function ($data) {
                            return isset($data->cr)?$data->cr:"";
                        },
          
            ],
            [
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'attribute' =>  'running_balance',
                'format'=>'raw',
		'filter'=>true,
                'header'=>'Balance',
                'value'=>function ($data) {
                    return $data->getRunningBalance();
                },
          
            ],
		
		
            // 'details:ntext',
            // 'date_created',
            // 'created_by',
            // 'date_modified',
            // 'modified_by',
];
             // Renders a export dropdown menu
   echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns,
        'exportConfig' => [
        //ExportMenu::FORMAT_TEXT => false,
        //ExportMenu::FORMAT_PDF => false
    ]
    ]) ;
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns  /* + 
                      */
       
    ]); ?>
		<?php Pjax::end(); ?>
</div>
    

</div>