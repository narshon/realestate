<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OccupancyRent */


?>

    <?= $this->render('_form', [
        'model' => $model, 'occupancy_id'=>$occupancy_id
    ]) ?>