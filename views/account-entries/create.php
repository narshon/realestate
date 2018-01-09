<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountEntries */

$this->title = 'Create Account Entries';
$this->params['breadcrumbs'][] = ['label' => 'Account Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-entries-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
