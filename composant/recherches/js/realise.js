$(".selectize-inp").selectize();

$(document).ready( function () {

 //
   
   
	
} );
 
passNext  = function(data,id) {

 //
     $(".pages").addClass("hidden");	 
	 $("#"+id).addClass("wow fadeInUp animated");
	 $("#"+id).removeClass("hidden");
   
	
}
 
 
 affSuivant  = function(e){
 
     var id = e.dataset.suiv;
 
 	 var type = parseInt( e.dataset.typ ) ;
	 
	 var inp  =  e.dataset.input ;	
	 
	 switch(type) {
		case 1:
		 var val = $('input[name="'+inp+'"]:checked').val();
	 
		 break;
		case 2:
		
		 var val = $('#'+inp ).val();
		break;
		case 3:
		
		var val = $('#'+inp ).val();

		break;
		case 4:
		
		var val = $('#'+inp ).val();
		break;
		case 5:
		
		var val = $('#'+inp ).val();
		break;
		case 6:
		
		var val = $('#'+inp ).val();
		break;
		default:
		// code block
		}  
		   if (val != undefined)
			  {
				  
				  
				  var idq  = e.dataset.idq;
				  var idt  = e.dataset.idt;
				  var idr  = e.dataset.idr;
				  var user = e.dataset.user;
				 
				  donnees = 'task=save&idt='+idt+'&idq='+idq+'&val='+val+"&user="+user+'&idr='+idr+'&t='+type;
				  ajax_send(donnees,"passNext(data,'"+id+"')");
					
			  } 
			  else 
			  
			  {
				  
				alert(val);
				
				  
				  
				  }


}

 

/***************************/
function ajax_send(donnees,func) {
 
 
  

			$.ajax({

            type:'POST',
            url:'send_ajx.php?option=tests', 
            data: donnees,
            success:function(data){
			 if (data!='') {
			 
			      
  console.log(data);
			  eval(func);
				
				    
				  
				 }  
				  
				 			 
				 
            }
        });
 
 
 
 } 
 