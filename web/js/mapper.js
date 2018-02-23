
function processEvents(e, ui)
{
    var parentId = ui.startparent.attr('id');
    if(parentId === 'bills_sortable-sortable') {
        processBalance(1, ui.item);
    }
    if(parentId === 'sorted_bills-sortable') {
        processBalance(0, ui.item);
    }
    processStatus();
    
}
function processStatus()
{
    var bill_amounts = getBillAmount([]);
    var balance = parseInt($('#occupancy-payments_pool').val());
    $('#bills_sortable-sortable li').each(function(i){
        var key = $(this).attr('data-key');
        if(bill_amounts[key] > balance) {
         $(this).addClass('disabled');
        }else {
            $(this).removeClass('disabled');
        }
    });
}
function getBillAmount(ids)
{
    var ret=[];
    $('#bills_sortable-sortable li').each(function(i){
        ids.push($(this).attr('data-key'));
    });
    $.ajax({
        url: $('#url_').val(),
        type: 'post',
        async: false,
        data: {
            ids : ids,
        },
        success: function(data){
            $.each(data, function(i, v){
                ret[i] = v;
            });
        }
    });
    return ret;
}

function processBalance(direction, item)
{
    $('.processing').show();
    
    var bill_amounts = getBillAmount([item.attr('data-key')]);
    var current_bal = parseInt($('#occupancy-payments_pool').val());
    if(direction === 1) {
        current_bal = current_bal - (bill_amounts[item.attr('data-key')]) / 2;
    }
    if(direction === 0) {
        current_bal = current_bal + (bill_amounts[item.attr('data-key')]);
    }
    $('#occupancy-payments_pool').val(current_bal);
    $('.processing').hide();
    
}


