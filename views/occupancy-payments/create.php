<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OccupancyPayments */

?>
<div class="occupancy-payments-create">
    <?= $this->render('_form', [
        'model' => $model, 'occupancy_id'=>$id
    ]) ?>

</div>
