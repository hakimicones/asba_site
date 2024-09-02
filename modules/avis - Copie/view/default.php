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
        <button id="btn_send"   class="btn btn-primary"> {send}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">  {close}</button>
      </div>
    </div>
  </div>
 
</div>
<!-- Fin Modal -->

<script type="text/javascript">
 
/*************************onclick="sendForm()" ********/

 
  

 
</script>

