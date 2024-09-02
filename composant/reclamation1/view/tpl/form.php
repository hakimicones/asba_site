<style >
  
   
</style>

<div id ="reclamation" class="container">

<div class="row">
  <div class="col-5 " id="inscription">
     <p></p>
  </div>

  </div>
  <div class="row">
    <div class="col-3"></div>

    <div id="form2" class="col-8"> 


<form id="form-2" method="post" enctype="multipart/form-data" class="center">
	
     <div class="form-group">
    <label for="exampleInputEmail1">{email}</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
  </div>
  <div class="form-group ">
    <label for="exampleInputPassword1">{pass}</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
<input name="task" type="hidden" value="reclamation">
<div class="btn-group ">
  <button type="submit" class="btn btn-primary">{send}</button>
</div>
</form>

</div>
 <div id="form" class="col-8 invisible"> 
<form id="form-1" method="post" enctype="multipart/form-data" class="center ">
	  <div class="form-group">
    <label for="nom">{nomprenom} *</label>
    <input class="form-control" id="nom" name="nom" required>
   
  </div>
  
     <div class="form-group">
    
    <div class="row">
    	
    
    <div class="form-check col-6">
  <label class="form-check-label" for="exampleRadios2">
{client}
  </label>
  <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="1" onclick="radioclick(1)" checked >

</div>
<div class="form-check col-6">
  <label class="form-check-label" for="exampleRadios3">
{pasclient}
  </label>
  <input class="form-check-input" type="radio" name="type" id="exampleRadios3" onclick="radioclick(2)" value="2"  >
</div></div>
   
  </div>   
  <div class="form-group" id ="divcompte">
    <label for="compte">{compte} </label>
    <input  class="form-control" id="compte" name="compte" >
  </div>
    <div class="form-group" id ="divcompte">
    <label for="compte">{tel} *</label>
    <input   type="number" class="form-control" id="tel" name="tel"  required>
  </div>
     <div class="form-group">
    <label for="email">{email} *</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" onblur="vrifemail()" required>
       <div id="msgemail" class="invalid-feedback">
          
        </div>
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">{pass} *</label>

    <div class="form-control-pass">
    <input type="password" class="control-pass" id="input-pass" name="password" required> 


    <a href="javascript:affPass()"><i class="fa fa-eye" id="i-btn" aria-hidden="true"></i></a>
    </div> 

  </div>
<input name="task" type="hidden" value="inscription">

  <button type="submit" class="btn btn-primary">{send}</button>

</form>
</div></div>
<div class="row">
      <div class="col-8">
      	 <div class="col-4" id="bg1"></div>
      	  <div class="col-4" id="bg2"></div>
      </div>

  <a href="javascript:"  id="login"class="col-2" onclick="inscriptionlogin()" > 
    <p id ="textbtn">{inscription}</p>
</a>

</div>
</div>

<script type="text/javascript">



 function  affPass() {
 

if ($("#input-pass").prop('type' ) == 'text')  {

$("#i-btn").prop("class","fa fa-eye");
$("#input-pass").prop('type', 'password') ;
}
else 
{

$("#i-btn").prop("class","fa fa-eye-slash");
$("#input-pass").prop('type', 'text'); 
}


 }


var login=1; 
  
function inscriptionlogin() {


if (login==1) {
      $("#form").attr( "class", "col-8 visible" );
      $("#form2").attr( "class", "col-8 invisible2" );

login=0;
$('#textbtn').text("{login}"); 

}else {
	login=1; 
	      $("#form2").attr( "class", "col-8 visible" );
	$("#form").attr( "class", "col-8 invisible2" );
	$('#textbtn').text("{inscription}"); 

}


} 
function ajax_send(donnees,msg) {
            $.ajax({
                type: 'POST',
                url: 'send_ajx.php?option=reclamation',
                data: donnees,
               success: function(data) {
                    

                    
                if (data!="") {
                $('#msg'+msg).text(data); 
                    $("#"+msg).attr( "class", "form-control is-invalid" );
					
					alert(msg);
                    document.getElementById(msg).value="";
                }
                else {
                  $("#"+msg).attr( "class", "form-control is-valid" );
                }
               
     
 
        
                    
                }
            });

}
function vrifemail() {
           var emailval=document.getElementById('email').value;
           var donnees = "postajax=email"+ "&" + "email="+emailval+"&lg={lg}"; ;
           var user= "email"; 
		   console.log(donnees);
           ajax_send(donnees,user); 
       

}
function radioclick(id) {

if (id==2) {
  document.getElementById("divcompte").style.display = "none";
  document.getElementById("form").style.padding = "120px 0px ";

}
else{
  document.getElementById("divcompte").style.display = "block";
   document.getElementById("form").style.padding = "80px 0px ";
}

}


</script>