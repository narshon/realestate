<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

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
        'brandLabel' => 'getKeja',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'my-navbar navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Hostels', 'url' => ['/site/hostel']],
            ['label' => 'Bed Sitters', 'url' => ['/site/bedsitter']],
            ['label' => 'Single Rooms', 'url' => ['/site/single']],
            ['label' => 'One BedRooms', 'url' => ['/site/onebr']],
            ['label' => 'Two BedRooms', 'url' => ['/site/twobr']],
            ['label' => 'Lodgings & Guest Houses', 'url' => ['/site/lodging']],
            ['label' => 'Maisonetts & Bungalows', 'url' => ['/site/maisonetts']],
            ['label' => 'Browse By Agents', 'url' => ['/site/agents']],
            ['label' => 'Blogs', 'url' => ['/site/blog']],
            ['label' => 'Admin', 'url' => ['/site/admin'],'visible'=>!Yii::$app->user->isGuest],
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
