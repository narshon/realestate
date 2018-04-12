<?php
use app\models\AccountEntries;
?>
<div id="statement_box" class="row mbl">

<div class="col-md-2 pull-right">
        <?= '<label class="control-label">Accounts</label>'?>
        <?=kartik\widgets\Select2::widget([
            'name' => 'account_statement',
            'id' => 'account-statement',
            'data' => \app\models\AccountChart::getAccountsOptions(),
            'options' => [
                'placeholder' => 'Select Account...',
                'multiple' => false
            ]
        ]);?>
    </div>
</div>