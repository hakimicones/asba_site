<style type="text/css">
   .display{
    display:none
  }
  .display_{lg}{
    display: flex; 
  }
 
  
    
</style>
{btn}
<div id ="ticket" class="container">
	<div class="card  bodyticket" style="padding: 15px">
    <h5 class="">{ticketsujet}</h5> 
  </div>
  <div class="row display display_ar " style="margin:0px; ">
        <div class="  card  bodyticket" style="margin : 20px 0px 20px 0px ;width: 100% ; padding: 15px">
            {departement} : {departementval}<br>
    {typedeticket} : {typeval}<br>
      {chiox} : {chioxval}<br>
       {etatticket} : {etatticketval}<br>
</div>
  <div class="  card  bodyticket" style="margin : 20px  0px 20px  0px; width: 100% ; padding: 15px"> {ticketbody}</div>

</div>
  <div class="row display display_fr " style="margin:0px ;  ">
     
  <div class="  card  bodyticket" style="margin : 20px 0px 20px 10px; width: 68% ; padding: 15px"> {ticketbody}</div>
     <div class="  card  bodyticket" style="margin : 20px 10px 20px 0px ;width: 100% ; padding: 15px">
            {departement} : {departementval}<br>
    {typedeticket} : {typeval}<br>
      {chiox} : {chioxval}<br>
       {etatticket} : {etatticketval}<br>
</div>

</div>
 {comment}
 {from}

            <script>

              function setResolu() {
                var donnees = "postajax=setResolu&t={userid}&id={ticketid}&lg={lg}"; 
               

                ajax_send(donnees, '','hideEditor'); 

              }


                function ergreplies() {
                var check=	document.getElementById("exampleCheck1").value ; 

                	 var editor=CKEDITOR.instances['editor1'].getData();
                   if (editor == '') { alert('texte vide'); return false;}


                   var donnees = "postajax=replies"+ "&" + "replies="+editor+"&t={userid}&u={ticketid}&lg={lg}&prive="+check; 
                   var user= "email"; 
                   ajax_send(donnees,user,'videEditor'); 

                }
                function ajax_send(donnees,msg,func) {
            $.ajax({
                type: 'POST',
                url: 'send_ajx.php?option=reclamation',
                data: donnees,
               success: function(data) {
                    

                    
                if (data!="") {
               document.getElementById("divreplies").innerHTML  = data; 

               if (func!='') {
                  console.log(func);
        
                eval(func+'()');


               }
                }
                
               
     
 
        
                    
                }
            });

}

  function hideEditor() {


    $('#btn-resolu').css("display","none");
    $('#formticket').css("display","none");
  
  }
 
 function videEditor() {

  CKEDITOR.instances['editor1'].setData('');
  }
 
// ensuite
 
            </script>
        
</div>