<!-- Avis -->
<div id="div_avis">
<!-- form Avis -->
<div id="menu_avis">
<form class="form_lignes" method="post" id="avis_form">
<h3> {avis} </h3>
		<input type="text" name="nom" placeholder="{nom}"  />
		<span id="name_validation" class="error_message"></span>
		<input type="text" name="email" placeholder="{email}" />
		<span id="email_validation" class="error_message"></span>
		
		<input type="text" name="sujet" placeholder="{sujet}" />
 
		<textarea name="message"  placeholder="{message}"   rows="4"></textarea>
		<span id="message_validation" class="error_message"></span>
		<button id="btn_send_sup" type="submit" class="btn btn-default"><i class="fa fa-paper-plane" aria-hidden="true"></i> {send}</button>
		<button id="btn_close" type="reset"class="btn btn-default"><i class="fa fa-close"></i> {close}</button>
		
</form>
<div id="mess_alert"></div>
<div class="tooltip-arrow" style="left: 50%;"></div>
</div>
<a href="javascript:" data-effect="shake"   id="btn_avis" class="btn_bas2 droite bottom_avis"  > {avis} </a>

</div> 
<!-- Fin Form Avis -->

<script type="text/javascript">
 $("#avis_form").submit(function(e){  

 e.preventDefault();  
 var donnees = $(this).serialize();
  
  
   $.ajax({ 
   		type: 'POST',
		url:  'send_ajx.php?option=avis',
		data: donnees,
				success:function(response) {
					 var html = '<div class=" "  >';
					 html    += '<p> <strong>Merci!</strong>'  +response+'</p>' ;
					 html    += '<button class="btn btn-primary" type="button" id="close_avis" > OK</button></div>';
					 $('#mess_alert').html( html);
					
 					$('#avis_form').fadeOut(300).css({'display':'none'});
					$('#avis_form').trigger("reset");
					 
					 $('#mess_alert').css({'display':'block'}); 
					 
					 $("#close_avis").click(function() {
 					 $('#menu_avis').fadeOut(300).css({'display':'none'}); avis= 1;
 					 $('#avis_form').css({'display':'block'});  
					 $('#mess_alert').html("");
					 $('#mess_alert').css({'display':'none'}); 
					  });
					 
				// 	$('#mess_alert').fadeOut(5000).css({'display':'none'}); 
				}
			});
			
			
});


</script>

 