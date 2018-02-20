
function processDEvents(e, ui)
{
    var parentId = ui.startparent.attr('id');
    if(parentId === 'bills_sortable-sortable') {
        processDBalance(1, ui.item);
    }
    if(parentId === 'sorted_bills-sortable') {
        processDBalance(0, ui.item);
    }
   // processDStatus();
    
}
function processDStatus()
{
    //var bill_amounts = getDBillAmount([]);
    var balance = parseInt($('#disbursements-payments_pool').val());
    var advances = parseInt($('#disbursements-payments_advance').val());
    
    $('#sorted_bills-sortable li').each(function(i){
        var key = $(this).attr('data-key');
       var bill_array = key.split('_');
      bill_amount = parseInt(bill_array[1]);
        balance  = (balance + bill_amount);
    });
     balance = balance - advances;
    $('#disbursements-payments_pool').val(balance);
    if(balance < 0){
        $('#map-btn').attr('disabled','disabled');
    }
    else{
        $('#map-btn').removeAttr('disabled');
    }
}
function getDBillAmount(ids)
{
    var ret='';
   /* $('#bills_sortable-sortable li').each(function(i){
        ids.push($(this).attr('data-key'));
    });  */
    $.ajax({
        url: $('#url_').val(),
        type: 'post',
        async: false,
        data: {
            ids : ids,
        },
        success: function(data){
            ret = data;
        }
    });
    
    return ret;
}

function processDBalance(direction, item)
{
    $('.processing').show();
    //check if this bill has not been added already.
    
     var bill_string = item.attr('data-key');
     var bill_array = bill_string.split('_');
      bill_amount = parseInt(bill_array[1]);
        
        var current_bal = parseInt($('#disbursements-payments_pool').val());

        if(direction === 1) {
            current_bal = current_bal + bill_amount;
        }
        if(direction === 0) {
            current_bal = current_bal - bill_amount;
        }
        $('#disbursements-payments_pool').val(current_bal);
        
        if(current_bal < 0){
            $('#map-btn').attr('disabled','disabled');
        }
        else{
            $('#map-btn').removeAttr('disabled');
        }
    
    $('.processing').hide();
}