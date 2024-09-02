
 var avis= 1 ;
		$("#btn_avis").click(function() { 
			 						 
			if (avis) {
						obj = $(this).get(0);
						var curleft     = obj.offsetLeft || 0;
						var curtop      = obj.offsetTop || 0;
						var curbottom   = obj.offsetBottom || 0;
				   while (obj = obj.offsetParent) {
							curleft    += obj.offsetLeft
							curtop     += obj.offsetTop
							curbottom  += obj.offsetBottom
				   }
				   
				   
				  $('#menu_sondage')
					.jAnimateSequence($(this).data('effect').split(' '), function(self, effects){
					 // alert(effects.join(', ') + ' done');
					});
					
					
					 
				 
				   $('#menu_suport').fadeOut(300).css({'display':'none'}); suport2 = 1
				   curtop   =  getWindowHeight()-280 ;  //$(window).height()-380;
				  // alert(curtop);
				  if (curleft  > 640) {
				   curleft  -=250
				  } else {
					curleft  -=120  
					  }
				   
				  // ,'top':'inherit'
				   avis= 0
				   
						$('#menu_sondage').css({'left':curleft+'px','position':'fixed','top': '340px','bottom':'30px'}).fadeIn(300).css({'display':'block'});
						 
						
			} else { $('#menu_sondage').fadeOut(300).css({'display':'none'}); avis= 1 }
						
						//$('#menu_sondage').on( "mouseleave",function() {  avis= 1 ;  $('#menu_sondage').fadeOut(300).css({'display':'none'}); });
						
						
						
												 
												} );
 
  

 
		
	 $("#btn_close").click(function() {
  $('#menu_sondage').fadeOut(300).css({'display':'none'}); avis= 1;
 
 
 });
	 
	 
function getWindowHeight() {
			var windowHeight=0;
			if (typeof(window.innerHeight)=='number') {
				windowHeight=window.innerHeight;
			} else {
				if (document.documentElement&& document.documentElement.clientHeight) {
					windowHeight = document.documentElement.clientHeight;
				} else {
					if (document.body&&document.body.clientHeight) {
						windowHeight=document.body.clientHeight;
					}
				}
			}
			return windowHeight;
		}	 