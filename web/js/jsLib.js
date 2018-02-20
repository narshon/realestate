/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function AJAX(){
	try{
	xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
	return xmlHttp;
	}
	catch (e){
	try{
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		return xmlHttp;
	}
	  catch (e){
			try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				return xmlHttp;
		}
		 catch (e){
			alert("Your browser does not support AJAX.");
			return false;
				}
			}
		}
	}





function showDiv(div,messageDiv,message){
    
    $("div#"+div).hide(); 
    $("div#"+messageDiv).html("<a href='#' onClick=\"hideDiv('"+div+"','"+messageDiv+"','"+message+"')\">+</a> "+message); 
    //$("div#"+div).text(""); 
    $("div#"+messageDiv).css("width","97.4%");
}
function hideDiv(div,messageDiv,message){
   
    $("div#"+div).show(); 
    $("div#"+messageDiv).html("<a href='#' onClick=\"showDiv('"+div+"','"+messageDiv+"','"+message+"')\">-</a>"); 
    $("div#"+messageDiv).css("width","");
    
}
function ajaxFormButton(uri,div,form){
        
       // alert($("#MalSlide_wbc").val()+" = "+$("#"+form).serialize());
        
     // Create xmlHttp
        var xmlHttpObject = AJAX();
        //alert($("#"+form).serialize());
        // The code...
        xmlHttpObject.onreadystatechange=function(){
                if(xmlHttpObject.readyState==4 ){
                   returnString = xmlHttpObject.responseText;
                  // returnArray = returnString.split("_'!^*'_");

                   //output = returnArray[1];
                   document.getElementById(div).innerHTML = xmlHttpObject.responseText;



                   parentGridArray = returnArray[0].split("=>");
                  // updateGridView(parentGridArray[1]);

                }
                else {   
                   document.getElementById(div).innerHTML="<img src='images/ajax-loader.gif' alt='Please Wait...'>";  
                }
        }

        var parameters="type=ajax&"+$("#"+form).serialize();

        xmlHttpObject.open("POST", uri, true);
        xmlHttpObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttpObject.send(parameters);
            
            
}


function ajaxFormSubmit(uri,div,form,show_wait, disable_pjax){
  
     
     $.ajax({
            type: "post",
            url:  uri,
            data: $("#"+form).serialize(),
            dataType: "json",
           beforeSend: function(x) {
              var wait;
              if(show_wait=='0'){
                  wait="Please wait"; 
              }
              else{
                  wait="<img src='images/ajax-loader.gif' alt='Please Wait...'>";
              }
             
              $('#'+div).html(wait);
              if(x && x.overrideMimeType) {
                    x.overrideMimeType("application/j-son;charset=UTF-8");
              }

            }, 

            success: function(data){   
                    $('#'+div).html(data.div);
                    $('#'+data.alert_div).addClass('alert alert-'+data.status);
                    $('#'+data.alert_div).html(data.message);
                    if(disable_pjax != 1){
                        $.pjax.reload({container: '#'+data.gridid, timeout: 5000}); 
                    }
            },
             error: function (response, status, message) {
                //alert("Error! "+response.toString()+" "+status);
              //  var err = JSON.parse(response.responseText);
                console.log(message);
              $('#'+div).html("An error occured.");
            }

    });  
         
}


function showBSdialog(model_name,model_id,view_file, title, uri){
    
      $.ajax({
        url: uri,  // "/cars/web/index.php?r=site/update-data",
        data: {model_name:model_name, model_id:model_id, view_file:view_file}
      }).success(function(data) {
         // console.log('Tuko hapa');
        $( this ).addClass( "done" );
        $('#modal_title_div').html(title);
        $('#modal_body_div').html(data.div);
      });

    $('#modal_id').modal('show'); 
}
  

function deleteDialogMessage(url,div,model, id){
    

    mess="<p> Are you sure you want to delete this item? </p>\n\
         <a href='#' onClick='ajaxDelete(\""+url+"\",\""+div+"\", \""+model+"\", \""+id+"\")'> DELETE </a> &nbsp; &nbsp; &nbsp; \n\
          <a href='#' onClick='closeDialogBox();' > CANCEL </a>";
 
    document.getElementById(div).innerHTML=mess;
    
}

function dialogContent(div ,title,content_id){
    
    content=$("div#"+content_id).html();
    //$("div#"+content_id).html("");
    $("div#"+content_id).show();
    document.getElementById("ui-dialog-title-dialog-id").innerHTML=title;
   // document.getElementById(div).innerHTML=content;
}

function ajaxDelete(uri, div, modelName, id){
   
     
     
     $.ajax({
            type: "GET",
            url:  uri,
            data: {model:modelName, id:id},
            dataType: "json",
            beforeSend: function(x) {  
              $('#'+div).html("<img src='images/ajax-loader.gif' alt='Please Wait...'>");
              if(x && x.overrideMimeType) {
                    x.overrideMimeType("application/j-son;charset=UTF-8");
              }

            },

            success: function(data){
                    
                    $('#'+div).html(data.div);
                   
                    if(data.redirect==1){
                        //redirect main page.
                        window.location=data.newpage;
                    }
                    
                    if(data.closeDialog == 1){
                        closeDialogBox(data.parent_grid);
                    }
                    //update grid
                    if(data.updateGrid == 1){ 
                        updateGrid(data.parent_grid);
                    }
                    
            },
             error: function (response, status) {
                //alert("Error! "+response.toString()+" "+status);
              $('#'+div).html("An error occured.");
            }

    });
}

function  showAjaxViewTabs(url,div,view_id, view_file){   
        
       // alert(view_id);
      // Create xmlHttp
            var xmlHttpObject = AJAX();

            // The code...
            xmlHttpObject.onreadystatechange=function(){
                    if(xmlHttpObject.readyState==4 ){
                      
                       document.getElementById(div).innerHTML=xmlHttpObject.responseText;

                    }
                    else {
                       document.getElementById(div).innerHTML="<img src='images/ajax-loader.gif' alt='Please Wait...'>";
                    }
            }
           
            var parameters="&view_id="+view_id+"&div="+div+"&view_file="+view_file;
             
            xmlHttpObject.open("GET", url+parameters, true);
            xmlHttpObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttpObject.send(null);
 }
 
 function updateGrid(parent_id)
{   
$.fn.yiiGridView.update(parent_id, {   
data: $(this).serialize()
});  
}

function closeDialogBox(dialog_id){
         // $("#StorageMedia-dialog-id").dialog('close');
         $("#dialog-id").dialog('close');
}

function ajaxUniversalGetRequest(uri,div,string, showPleaseWait){
    
     
     $.ajax({
            type: "GET",
            url:  uri,
            data: {string: string},
            dataType: "json",
            beforeSend: function(x) {  
               if(showPleaseWait==1){
                    $('#'+div).html("<img src='web/images/ajax-loader.gif' alt='Please Wait...'>");
               }
            if(x && x.overrideMimeType) {
                    x.overrideMimeType("application/j-son;charset=UTF-8");
              }

            },

            success: function(data){
                if(data){ 
                    $('#'+div).html(data.div);
                    if(data.redirect==1){
                        //redirect main page.
                        
                        window.location=data.newpage;
                    }
                    if(data.reload==1){
                        location.reload();
                       //updateGridView("yw0")
                    }
                    //update grid
                    if(data.updateGrid == 1){
                        updateGridView(data.parent_grid);
                    }
                    
                 }
            },
             error: function (response, status,errorThrown) {
               // alert("Error! "+response.statusText+" "+errorThrown);
              $('#'+div).html("An error occured."+response.statusText+" "+errorThrown);
            }

    });
         
}

function strtoupper (str) {
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Onno Marsman
  // *     example 1: strtoupper('Kevin van Zonneveld');
  // *     returns 1: 'KEVIN VAN ZONNEVELD'
  return (str + '').toUpperCase();
}

function ucfirst (str) {
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Onno Marsman
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: ucfirst('kevin van zonneveld');
  // *     returns 1: 'Kevin van zonneveld'
  str += '';
  var f = str.charAt(0).toUpperCase();
  return f + str.substr(1);
}

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

function uploadFile(url, divid, field){
    var formData = new FormData(); 
    formData.append(field, $('input[type=file]')[0].files[0]);
 
            $.ajax({
                type: 'POST',
                url:  url,  //"RealEstate/web/index.php?r=site/upload",

                processData: false,
                contentType: false,
                data: formData,
            beforeSend: function(x) {  
                $('#'+divid).html("<img src='web/images/ajax-loader.gif' alt='Please Wait...'>");
            },
            success: function(data){   
                    $('#'+divid).html(data.div);
                    $('#propertyfeatureimage-img_temp_url').attr('value', data.val);
                    console.log(data.div);   
            },
             error: function (response, status, message) {
                //alert("Error! "+response.toString()+" "+status);
              //  var err = JSON.parse(response.responseText);
              console.log(message);
              $('#'+divid).html("An error occured.");
            }
            });
}

function redirectTo(url){
    
    window.location.replace(url);
}

$('body').on('click', '.print-modal', function(){
    printSection($('#print_area'));
    window.print();
});

$('body').on('change', '#users-selected_property', function(){
    var selected = $('#users-selected_property').val();
    if(selected !== '') {
        generatestatement(selected);
    }
});

$('body').on('change', '#daily-summary', function(){
    getFinanceDailySummary($(this));
});

function generatestatement(id)
{
    $.ajax({
        url: 'statement',
        type: 'post',
        data: {id:id},
        beforeSend: function(){
            $('.container-loader').addClass('container-loader');
            $('.statement').html('');
        },
        complete: function(){
            $('.container-loader').removeClass('container-loader');
        },
        success:function(data){
            $('.statement').html(data);
        }
    });
}

function printSection(elem)
{
    var domClone = elem.cloneNode(true);
    var printSection = document.createElement('div');
    printSection.id = 'printSection';
    document.body.appendChild(printSection);
    printSection.innerHTML = '';
    printSection.appendChild(domClone);
    alert('mimi')
    
}

function getFinanceDailySummary(elem)
{
    var item = elem.find(':selected');
    $.ajax({
        url: 'daily-summary',
        type: 'post',
        data: {id:item.val()},
        beforeSend: function(){
            $('.summary-loader').addClass('container-loader');
            $('.summary-content').html('');
        },
        complete: function(){
            $('.summary-loader').removeClass('container-loader');
        },
        success:function(data){
            $('.summary-content').html(data);
        }
    });
    
}




