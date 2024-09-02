
<div class="container">
<form class="form" id="form_cv" enctype="multipart/form-data" action="" method="post" onsubmit="return validateMyForm();">
	<div class="form-group">
		<label for="nom">{nomprenom} :</label>
		<input type="text" name="nom" id="nom" placeholder="{nomprenom}" class="form-control">
		</div>
	 	<div class="form-group">
			<label for="email">{email} :</label>
			<input type="text" name="email" id="email" placeholder="{email}" class="form-control">
		
		</div>
		<div class="form-group">
		<label for="sujet">{sujet} :</label>
		<input type="text" name="sujet" placeholder="{sujet}" id="sujet" class="form-control">
		
		</div>
		
		
		<div class="form-group">
		<label for="message">{message} :</label>
		<textarea class="form-control" name="message" id="message" rows="3"></textarea>
		 
		</div>
		<div class="form-group">
    <label for="jointe">{jointe} : (IMAGES/PDF/DOCX/DOC) </label>
    <input type="file" class="form-control-file" id="jointe" name="jointe">
  </div>
  
  <hr />
		 <input type="hidden" name="task" value="sendCv" />
  <div class="form-group">
 <label id="human-question"> </label>
		<input id="human-answer"  type="text" />
  </div>
 
		<div class="div-btn"> 
	 <button type="submit" class="btn btn-secondary">{send}</button>
	 
	 </div>
		
</form>
</div>

<script>

var numbers = ["{zero}", "{un}", "{deux}", "{trois}", "{quatre}", "{cinq}", "{six}", "{sept}", "{huit}", "{neuf}", "{dix}"];


var num1 = Math.floor(Math.random() * 10);
var num2 = Math.floor(Math.random() * 10);
document.getElementById('human-question').innerHTML = "{Combien font} " + numbers[num1] + " {plus} " + numbers[num2] + " {?}";

 
 
function validateMyForm()
{

   var file = document.getElementById("jointe");
   if(file.files.length == 0 ){
                alert('Vous devez envoyer votre CV');
				document.getElementById('jointe').style.backgroundColor = "red";
				return false;
            } 
   var sum = document.getElementById('human-answer').value;
    if(Number.parseInt(sum) != num1 + num2  ) {
 		alert("Désolé, votre calcul est incorrect, cela laisse penser que vous êtes un robot.");
 		document.getElementById('human-answer').style.backgroundColor = "red";
 	return false;
 } else {
 document.getElementById('form_cv').action = "{action}";
 
 }
 
  return true;
}
</script>