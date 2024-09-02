<!-- Debut Modal -->
 <div id="commentaires"> </div>
<div class="modal fade" id="votreAvisForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> {title}     </h5>
         
      </div>
      <div class="modal-body">
        <form class="form_lignes" method="post" id="contact_form">
		<input type="text" name="name" placeholder="{nom}"  />
		<span id="name_validation" class="error_message"></span>
		<input type="text" name="email" placeholder="{email}" />
		<span id="email_validation" class="error_message"></span>
		
		<input type="text" name="sujet" placeholder="{sujet}" />
 
		<textarea name="message"  placeholder="{message}"   rows="10"></textarea>
		<span id="message_validation" class="error_message"></span>
		</form>
      </div>
      <div class="modal-footer">
        <button id="btn_send" type="button" class="btn btn-primary"> {send}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">  {close}</button>
      </div>
    </div>
  </div>
 
</div>
<!-- Fin Modal -->

<script type="text/javascript">
 
/*********************************/


 
$("#contact_form").submit(function(e){ // On sélectionne le formulaire par son identifiant
 e.preventDefault(); // Le navigateur ne peut pas envoyer le formulaire
 var donnees = $(this).serialize(); // On créer une variable content le formulaire sérialisé

			  $.ajax({
				type: 'POST',
				url: 'send_ajx.php',
				contentType: false,
				processData: false,
				data: form_data,
				success:function(response) {
					alert(response);
					$('#selectfile').val('');
					 
				}
			});

});

 
</script>

