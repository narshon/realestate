<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\helpers\Url;
use app\models\AccountsTransaction;
use yii\widgets\Pjax;
use app\models\Journal;
use app\models\Source;
use app\models\Account;
use kartik\widgets\Select2;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\models\Members;
use yii\bootstrap\Button;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountsTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts Transactions';
?>
<div class="accounts-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
        $buttonurl= Url::to(['accounts-transaction/sendreport']);
    echo Button::widget(["label" => "Download Report", "options" => ["class" => "btn-danger grid-button pull-right btn-margin", "onclick"=>"redirectTo('$buttonurl')"]]);
    
    ?>
    

 <?php Pjax::begin(['id'=>'pjax-accounts-transaction',]); 
    
        
        $columns = AccountsTransaction::generateTransactionsReportColumns();
    
  /*  echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns, //array_merge(AccountsTransaction::getHeaderColumnsForExport(), $columns),
        'exportConfig' => [
        //ExportMenu::FORMAT_TEXT => false,
        //ExportMenu::FORMAT_PDF => false
    ]
    ]); */
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		//'header'=>true,
		'beforeHeader' => [
		  //put your header rows here!
		  [
		    'columns' => AccountsTransaction::getHeaderColumns(),
		  ]
		], 
        'columns' => $columns  /* + 
                      */
       
    ]); ?>
		<?php Pjax::end(); ?>
    
 
</div>
