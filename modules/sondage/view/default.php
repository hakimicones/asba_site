<!-- Avis -->
<div id="div_avis">
<!-- form Avis -->
<div id="menu_sondage" style="padding:10px 30px;">
<form   method="post" id="avis_form">
 <div class="question">{question}</div>
  <div class="reponse" id="reponse">
{reponses}
</div>

<input type="hidden" id="id_sondage"  name="id_sondage" value="{item}" />
 	<button type="submit" class="btn btn-default" id="btn1"> {send}</button>
 	<button type="button" class="btn btn-default"  id="btn_close">{close}</button>	
</form>
<div id="mess_alert"></div>
<div class="tooltip-arrow" style="left: 50%;"></div>
</div>
<a href="javascript:" data-effect="shake"   id="btn_avis" class="btn_bas2 droite bottom_avis"  > {avis} </a>

</div> 
<!-- Fin Form Avis -->
<script src=" modules/sondage/assets/script.js" type="text/javascript"></script>
<script type="text/javascript">

$( "input" ).on( "click", function() {
 var id= $('input:checked').val(); 

 
});  

 $("#avis_form").submit(function(e){  


 e.preventDefault();  
 var donnees = $(this).serialize();
   var id= $('input:checked').val(); 
 //
   $.ajax({ 
   		type: 'POST',
		url:  'send_ajx.php?option=sondage',
		data: donnees,
				success:function(response) {
					 
					 $('#reponse').html( response);
					 $('#btn1').css({'display':'none'}); 
 					 
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

 