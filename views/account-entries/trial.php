<?php

use yii\bootstrap\Collapse;


$this->registerCss("
            .container{
                width:98% !important;
            }
            .leftbar{
               background: #B5121B;
               color:#ffffff !important;
               padding-top:10px;
            }
            .leftbar a{
                color:#ffffff !important;
            }
            .leftbar a:hover, a:active{
                color:#000000 !important;;
                /* background-color: #000000 !important; */
            }
            
            .rightbar{
                
            }
        "); 
?>
<div  class="account-entries-index panel panel-danger admin-content">
   <div class="panel-heading">
        <h1>Financial Records</h1>
   </div>

    <div class="panel-body">
	<div class="leftbar__ col-md-2">
            <ul class="nav nav-tabs" id="myTab__" role="tablist">
                          
                <?php
                echo Collapse::widget([
                    'items' => \app\models\AccountEntries::getNavigationItems()
                ]); ?>
	     </ul> 
	</div>
        <div id="statement_box" class="rightbar col-md-10">

        <h3> Trial Balance </h3>

        </div>
    </div>
</div>