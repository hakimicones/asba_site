<style>

.custom-file-label {
    text-align: left;
}
.modal-body {
   padding: 20px;  
}
.form-check-label { padding-left: 25px;   }

</style>


<div class="container">
	<div class="white-form">
		<form class="form_lignes" id="form_cv" method="post" role="form" data-toggle="validator" enctype="multipart/form-data">
			<h3>{libelle}</h3>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="adresse">{nom}</label>
						<input type="text" class="form-control" name="nom" placeholder="{nom}"  required>
					</div> 
				</div> 	
				<div class="col-sm-6">
					<div class="form-group">
						<label for="adresse">{prenom}</label>
						<input type="text" class="form-control" name="prenom" placeholder="{prenom}"  required>
					</div> 
				</div> 
			</div>

			{nomprenom_latin}
			<div class="form-group">
			<label for="adresse">{adresse}</label>
					<input type="text" class="form-control"  name="adresse" placeholder="{adresse}">
			 
			</div>
			 
			<div class="row">
				<div class="col-sm-6">
					<label for="tel">{tel}</label>
					<input class="form-control"  type="text" name="tel" placeholder="{tel}">
				</div>
				<div class="col-sm-6">
				<label for="email">{email}</label>
					<input class="form-control"  type="email" name="email" placeholder="{email}" required>	
			   	</div>
			</div>
			 
			<div class="row">
				<div class="col-sm-6">
				<label for="nele">{nele}</label>
					<input class="form-control"  type="date" name="nele" placeholder="{nele}">
				</div>
				<div class="col-sm-6">
				<label for="lieu">{lieu}</label>
					<input class="form-control"  type="text" name="lieu" placeholder="{lieu}">
				</div>
			</div>
		
			 
			<div class="row">
				<div class="col-sm-6 ">   
				 
				<br> 
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sex" id="sex1" value="1" checked>
						<label class="form-check-label" for="inlineRadio1"> {homme} </label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sex" id="sex2" value="2">
						<label class="form-check-label" for="inlineRadio2"> {femme} </label>
					</div>
					 

				</div>
			</div>
				<hr>
				<div class="row">
				<div class="col-sm-6 selectContainer">
				<label for="formation">{formation}</label>				
					{liste formation}				
				</div>
				<div class="col-sm-6 selectContainer">
				<label for="formation">{experience}</label>
				{liste experience}
				</div>
			</div>
			 <br>
				 
				<hr> 
				<div class="custom-file">
    <label class="custom-file-label" for="customFile">{upload} {cv}</label>
    <input type="file" name="pdf_file" class="custom-file-input" id="customFile">
  </div>

  <hr>
  <div class="g-recaptcha" data-sitekey="6LfLB2YqAAAAAJFqOWLkM5ddQ48u2Dj56hShDdcg"></div>
  <hr> 		
			<input name="task" type="hidden" value="candidat">
			<input name="id_offre" type="hidden" value="{id_offre}">
			<button type="button"  class="btn btn-primary"  onclick="validateForm()">
					{postuler} 
			</button>

<!-- Modal -->
<div class="modal fade" data-backdrop="static"  id="validation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> معالجة معطياتي </h5>
        
      </div>
      <div class="modal-body ">
          {text_contenu}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{close}</button>
        <button class="btn btn-primary" type="submit"> {postuler} </button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


			 
		</form>
	</div>
</div>
<hr>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>

/*
6LfLB2YqAAAAADY1ozj1f0fS05GCkbbr_eJ8EOil
*/

/*

$(".select-pick").selectpicker().change(function(e) {
			var id = "autre_" + $(this).attr("name");
			if($(this).val() == "autre") {
				$("#" + id).css('display','block');   } else {
					$("#" + id).css('display','none'); }
					})



  $(document).ready(function() {
            $("#form_cv").on("submit", function(event) {
                 event.preventDefault();

                 alert("envoie");


            });
        });
 
*/

 

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function validateForm() 
{

    // Vérifier si le reCAPTCHA a été coché
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
        alert("Veuillez cocher le reCAPTCHA avant d'envoyer le formulaire.");
        return false;
    }
    // Si le reCAPTCHA est coché, envoyer le formulaire
    $('#validation').modal('show');
}   
 
</script>