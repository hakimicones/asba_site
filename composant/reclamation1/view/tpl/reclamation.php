 

{btn}

<div id ="reclamation2" class="container">

<form method="post" enctype="multipart/form-data">
   <div class="form-group">
    <label for="exampleFormControlTextarea1">{sujet}</label>
     <input type="title" class="form-control" id="title" name="title" >
       </div>
<div class="form-group">
    <label for="exampleFormControlSelect1">{typedeticket}</label>
    <select class="form-control" id="type" onchange="fctchoix()" name="type" required>
     <option value="">{typedeticket}</option>
      {optiontypeticket}
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">{departement}</label>
    <select class="form-control" id="exampleFormControlSelect2" name="department" required>
           <option value="">{departement}</option>
      {optiondepartementticket}
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">{chiox}</label>

    <select class="form-control" id="choix" name="choix" required>
               <option value="">{chiox}</option>

        </select>
  </div>
 
    <div class="form-group">
    <label for="exampleFormControlTextarea1">{details}</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="text" required></textarea>
  </div>
  <input name="task" type="hidden" value="reclamationeng">
  <input id="uesr" name="user" type="hidden" value="{userid}">

    <button type="submit" class="btn btn-primary">{send}</button>

</form>
</div>

<script>

  function ajax_send(donnees,resultas) {
            $.ajax({
                type: 'POST',
                url: 'send_ajx.php?option=reclamation',
                data: donnees,
               success: function(data) {
                    

                    
               
                $("#choix").append(data);
                 resultas=data; 
 
        
                    
                }
            });

}
function fctchoix() {
            var type=document.getElementById('type').value;
            var donnees = "postajax=choix"+ "&" + "type="+type; ;
           var typeaffiche="";
            $("#choix option").remove();
            ajax_send(donnees,typeaffiche); 
             $("#choix").append(typeaffiche);
     
}




</script>