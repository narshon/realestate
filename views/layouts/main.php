<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
    <?php 
        $this->registerCss("
            .dropdown:hover .dropdown-menu {
                display: block;
            }
            .my-navbar { background: #B5121B;} 
            .my-navbar a{color:#fff !important }
            .my-navbar a:hover{color:#000 !important }
            .dropdown-menu a{color:#000 !important}
        "); 
        
    ?> 
 

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Jongeto Agency',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'my-navbar navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
           // ['label' => 'Hostels', 'url' => ['/site/hostel']],
            //['label' => 'Bed Sitters', 'url' => ['/site/bedsitter']],
           // ['label' => 'Single Rooms', 'url' => ['/site/single']],
           // ['label' => 'One BedRooms', 'url' => ['/site/onebr']],
		   ['label' => 'Dashboard', 'url' => ['/site/dashboard'],'visible'=>app\models\Users::isAgent()],
		   ['label' => 'Landlords', 'url' => ['/sys-users/landlord'],'visible'=>app\models\Users::isAgent()],
		   ['label' => 'Properties', 'url' => ['/property/index'],'visible'=>app\models\Users::isAgent()],
		   ['label' => 'Tenant', 'url' => ['/sys-users/tenant'],'visible'=>app\models\Users::isAgent()],
		   ['label' => 'Finance', 'url' => ['/journal/index'],'visible'=>app\models\Users::isAgent()],
		   ['label' => 'settings', 'url' => ['/county/index'],'visible'=>app\models\Users::isAgent()],
			['label' => 'Reports', 'url' => ['/accounts-transaction/report'],'visible'=>app\models\Users::isAgent()],
			
            //['label' => 'Two BedRooms', 'url' => ['/site/twobr']],
            //['label' => 'Lodgings & Guest Houses', 'url' => ['/site/lodging']],
           // ['label' => 'Maisonetts & Bungalows', 'url' => ['/site/maisonetts']],
           // ['label' => 'Browse By Agents', 'url' => ['/site/agents']],
            //['label' => 'Blogs', 'url' => ['/site/blog']],
			
            ['label' => 'Admin', 'url' => ['/site/admin'],'visible'=>app\models\Users::isAdmin()],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
   <?php if(strtolower(Yii::$app->controller->id) == 'site' && strtolower(Yii::$app->controller->action->id) == 'index' ) { ?> 
   <div class="jumbotron homebanner">
       <div class="bgimage"></div>
                <div class="homebannerform">
                    <?php //render partial the main search form
                        echo Yii::$app->controller->renderPartial('searchform');
                     ?>
                </div>
                    
    </div> 
   <?php } ?>
    <div class="container">
        <?php /* echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) */ ?>
        
        <?= $content ?>
    </div>
</div>
<?php 
 $url = Url::to('@web/js/jsLib.js', true);
$this->registerJsFile($url, ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

     <?php
       // Using a select2 widget inside a modal dialog
        Modal::begin([
            'options' => [
                'id' => 'modal_id',
                'tabindex' => false // important for Select2 to work properly
            ],
            'header' => '<div id="modal_title_div"> <h4 style="margin:0; padding:0">Real Estate</h4> </div>',
           // 'toggleButton' => ['label' => 'Show Modal', 'class' => 'btn btn-lg btn-primary'],
        ]);
       
        echo '<div class="modal-body" id="modal_body_div"> </div>';
          
        Modal::end();  
     ?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
