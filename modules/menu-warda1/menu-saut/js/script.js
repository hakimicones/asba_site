// JavaScript Document
$('.bouton').mouseover(function() {
$(this).clearQueue().animate({'margin-top': '0px'}) ;
var li = $(this).data('link');
$("#"+li).effect( "bounce" )
	
	   });  
	
$('.bouton').mouseout(function() {
	
$('.bouton').clearQueue().animate({'margin-top': '15px'});
	
	
	});  
	
	
 /********************************************************/
  
 
 
 /***********************************************************/
 
 

 
 