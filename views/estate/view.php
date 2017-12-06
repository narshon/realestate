<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            
						[
                            'label' => 'Sub Location',
                             'format'=>'raw',
                             'value' =>$model->fkSubLocation->sub_loc_name,
                         ],
            'estate_name',
            'estate_desc:ntext',
            'estate_review:ntext',
            'estate_media:ntext',
            'date_created',
            'date_modified',
            'created_by',
            'modified_by',
        ],
    ]) ?>

</div>
