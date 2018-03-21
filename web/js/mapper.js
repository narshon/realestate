
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
	//mapStatus();
    
}
function processStatus()
{
   // var bill_amounts = getBillAmount([]);
    var balance = parseInt($('#occupancy-payments_pool').val());
    $('#bills_sortable-sortable li').each(function(i){
        var key = $(this).attr('data-key');
		var bill_array = key.split('_');
        bill_amount = parseInt(bill_array[1]);
        //  balance  = (balance - bill_amount);
		$('#occupancy-payments_pool').val(balance);
        if(bill_amount > balance) {
         $(this).addClass('disabled');
        }else {
            $(this).removeClass('disabled');
        }
    });
}
function mapStatus()
{
   var bool = true;
   var total_bills = 0;
    var balance = parseInt($('#occupancy-payments_pool').val());
    $('#sorted_bills-sortable li').each(function(i){
        var key = $(this).attr('data-key');
		var bill_array = key.split('_');
        bill_amount = parseInt(bill_array[1]);
        total_bills += bill_amount;
        
    });
	
	if(balance < 0) {
         $('#map-btn').addClass('disabled');
		   bool = false;
		 // alert(balance +"<"+ 0 )
        }else {
            $('#map-btn').removeClass('disabled');
			 bool = true;
		 // 	alert(balance +">"+ 0 )
			
        }
	return bool;
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
    
    //var bill_amounts = getBillAmount([item.attr('data-key')]);
	var bill_string = item.attr('data-key');
     var bill_array = bill_string.split('_');
      bill_amount = parseInt(bill_array[1]);
	  
    var current_bal = parseInt($('#occupancy-payments_pool').val());
    if(direction === 1) {
        current_bal = current_bal - bill_amount;
    }
    if(direction === 0) {
        current_bal = current_bal + bill_amount;
    }
    $('#occupancy-payments_pool').val(current_bal);
	if(current_bal < 0){
            $('#map-btn').attr('disabled','disabled');
        }
        else{
            $('#map-btn').removeAttr('disabled');
        }
    $('.processing').hide();
    
}


