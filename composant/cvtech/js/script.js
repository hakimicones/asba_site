 /****************************/
 
 $(document.body).on("change","#categories",function(){
													 
                             var lg  = $("#lg").val(); 
							 var lbl = $("#label-sous-categorie").val();

							 var donnees = "task=AffModel&id="+this.value+"&lg="+lg +"&label="+lbl;
							 
							 var data = ajax_send(donnees,"#sous-categories"); 
							 
			
                                              



							 
					});

                
 
function search() {
	
	 $("#cvtech-form").submit();
	
	}
	
function affDescription(id) {      
	$('#btn-'+id).fadeOut(); //css("display","none");
	$('#pan-'+id).collapse('show');
}

function cacheDescription(id) {  

 
	$('#pan-'+id).collapse('hide');    
	$('#btn-'+id).fadeIn() ;  //css("display","block");
}
function ajax_send(donnees,elem) {
$.ajax({
            type:'POST',
            url:'send_ajx.php?option=cvtech', 
            data: donnees,
			dataType: 'json',
            success:function(data){
			 
               
			 
               $(elem).empty().append(data.options);
			   
			   
				 
				 
				  
				 
				 
            },
            error:function(jqXHR, exception){
             var msg = '';
			 console.log(jqXHR);
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Format JSON Erroné.';
			
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
			
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
            alert("Erreur : "+msg);
            }
        });

}