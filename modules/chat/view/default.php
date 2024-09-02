 <div id="menu_suport" class="container"> 
<span class="btn-off"></span>

 <form class="form_lignes" id="support_form" method="post"  >
 <div class="message">
 
 <p >
  {message_chat}
 </p>
 </div>
		<input type="text" name="nom" placeholder="{nom}" />
		<input type="text" name="email" placeholder="{email}" />
		<textarea name="message"  placeholder="{message}"   rows="2"></textarea>
		 <button id="btn_send_sup" type="submit" class="btn btn-default"><i class="fa fa-paper-plane" aria-hidden="true"></i> {send}</button>
		</form>
<span class="p_fr bas pull-left" >{message2}  </span>
<div class="tooltip-arrow"  ></div>
</div>

<script>
 
$("#support_form").submit(function(e){  

 e.preventDefault();  
 var donnees = $(this).serialize();
  
  
   $.ajax({ 
   		type: 'POST',
		url:  'send_ajx.php?option=chat',
		data: donnees,
		success:function(response) {
					alert(response);
					
					 
				}
		 	
			});
});

 

			

					 
					 
				 

 



</script>

