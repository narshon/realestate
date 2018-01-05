<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\utilities\DataHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>
<p>
                <?php 
                      $url = Url::to(['sys-users/setoccupanttenantform','fk_sublet_id'=>$fk_sublet_id,]);
                      echo Html::a("New Tenant","#",['onclick'=>"ajaxUniversalGetRequest('$url','modal_body_div','', 1)",'class'=>"btn btn-danger pull-right"]);
                     // echo $querystring;
                ?>
            </p>
             <?php Pjax::begin(['id'=>'pjax-sys-users',]); 
             
            // echo "Hapa", $querystring; ?> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'name',
                        'label' => 'Names',
                        'format'=>'raw',
                        'value' => function($data)use($fk_sublet_id){
                
                                return $data->setOccupancylink($fk_sublet_id);
                        }
                    ],
                    [
                        'attribute' => 'phone',
                        'label' => 'Phone',
                        'filter'=>false,
                        'value' => 'phone'
                    ],
                    [
                        'attribute' => 'email',
                        'label' => 'Email',
                        'filter'=>false,
                        'value' => 'email'
                    ],
                    [
                        'attribute' => 'id_number',
                        'label' => 'ID Number',
                        'filter'=>false,
                        'value' => 'id_number'
                    ],
                    // 'name2',
                    // 'name3',
                    // 'age',
                    // 'email:email',
                    // 'phone',
                    // 'address:ntext',
                    // 'date_added',
                    // 'gender',
                    // 'color_code',
                    // 'icon_id',
                ],
            ]); ?>
             <?php Pjax::end(); ?>