 
 
 
		 
			<div id="simulation1"  >
			
			
			
			</div>
			 
			
		 
 
 
<script src="composant/simulations/assets/js/simul.js" type="text/javascript"></script>
<script>
function num(e) {

	 


	 		var a = e.value 
	 		a = a.replace(",00","");
	 		a = a.replace('.',""); 
	 		a = a.replace('.',"");
	 		a = a.split(' ');
 	

	 		var b = "";
	 		b= a ;
 		  
 		//console.log("Valeur de "+e.name+" : "+ b) ;

 		 
 		 e.value = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'DZD' }).format(b).replace("DZD","") ;


		 }


/****************************************/

var tsu  = false ;
	var html = ''; 
   
   
        {listevehicules}
	
	html +=affRubTag('{convs}','{convention}','{lg}','',' hasValue ');
	
	//html +=affRubHidden('montantBien' , '{prix}','readonly="true"' );
	
	
	html +=affRubHidden('tauxCharge' , '10.5','readonly="true"' );
	
	html +=affRubTexte('salaireEmp','{salaire emprunteur}','{lg}', 'onblur="num(this)"',' hasValue'); 
	            
    html +=affRubTexte('salaireCoEmp','{salaire co-emprunteur}','{lg}', 'value="0" onblur="num(this)" ','hasValue'); 


    html +=affRubHidden('salaireCumule','0','readonly="true"' );
   // html +=affRubTexte('salaireCumule','{salaire Cumule}','{lg}','readonly="true"','',' hasValue');  
	
	html +=affRubHidden('tauxCapacite' , '30','readonly="true"' );   
	html +=affRubHidden('capaciteBrute' , '','readonly="true"' );
	
	html +=affRubHidden('capaciteConsomm' , '0','readonly="true"' );
	html +=affRubHidden('capaciteCautionConsomm' , '0','readonly="true"' );
	
		                                    
  
		html +=affRubHidden('capaciteNette' , '','readonly="true"' );
	
	html +=affRubHidden('tauxMaxFin' , '90','readonly="true"' );


	/*  
	 html +=affRubTexte('sliderNb','{Nombre d echeances}','{lg}',' data-slider-id="sliderNb" id="nbEcheance" name="nbEcheance" type="text" data-slider-min="24" data-slider-max="60" data-slider-step="1" data-slider-value="24" data-slider-selection="after" data-slider-tooltip="show"',' hasValue slider nb_ech' ); 
*/
	html +=affRubSelectAn( "sliderNb",'{Nombre d echeances}',60,'{lg}','id="nbEcheance" name="nbEcheance"', 60 , 'hasValue' );
	//html +=affRubTexte('apportMinimum','{participation Client}','{lg}','readonly="true"',' no-data' );
 	html +=affRubTexte('apportPersonnel','{participation Client}','{lg}','readonly="true"','hasData' ); 
	 
	 html +='<span class="help-block no-data" id="apportMin"></span>';
 


   html +='<div class="form-group">';
    	html +=affRubTexte('montantEcheance','{montant echeance}','{lg}','readonly="true"' ,''); 
	
	
	html +=affRubHidden('montantCredit','0','readonly="true"' );
	//html +=affRubTexte('montantCredit','{montant a financer }','{lg}','readonly="true"' ,' hasValue hasSep'); 

	html +='<span class="help-block" id="pourcentFin"></span>';	
	html +='  </div>';	
		
    


   html +=' <div class="form-group">'; 
   html +=affRubHidden('montantRembour' , '80','readonly="true"' );
   html +='</div>';
   
   
   html +=' <div class="form-group">';
   html +=affRubHidden('montantMarget' , '0','readonly="true"' );
   html +='</div>';
   
 
   html +='<div class="form-group"> '; 
   html +=affRubHidden('montantTva' , '0','readonly="true"' );
   html +='</div>';
   
    html +='<div class="MessageBas col-md-12">{message7}<br>';
    html +=' {message8}</div>';
   
   /*            
   html +='<div class="col-md-10">';
   html +='{message7}</div>';

*/	 
	
	$('#simulation1').html(html) ;

function info() { 

  // alert(val()); 
  var t = $('#tauxCharge').find(':selected').attr("data-max") ;
   
   $('#tauxMaxFin').val(t);
   }
   	
	$(document).on('change keyup','.hasValue',function(e)  {
            e.preventDefault();
			 
            console.log(e)
            updateCalc(false,{tva},tsu);
        });
		
		$(document).on('change keyup','.hasData',function(e)  {
            e.preventDefault();
			 
            
            updateCalc(true,{tva},tsu);
        });

        $(document).on('change keyup','.hasTaux',function(e)  {
            e.preventDefault();
            $(this).val($(this).val());
             
            updateCalc(false,{tva},tsu);
        });


        $(document).on('change keyup','.hasUpdate',function(e)  {
            e.preventDefault();
            if(apport != null && parseFloat($(this).val().split(" ").join("")) >= apport && parseFloat($(this).val().split(" ").join("")) <= montantBien){
                $(this).attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
                //update mntcredit && echeance
                updateCalc(true,{tva},tsu);
            }
            else {
                $(this).attr('style', "border-radius: 0px; border:#FF0000 1px solid;");
                $("#montantRembour").val("");
                $("#montantMarget").val("");
                $("#montantTva").val("");
                $("#totalMarge").val("");
                $("#montantEcheance").val("");
            }

        });


function affModel(){
     var id		= $( "#Marques" ).val();
	 var type   = $( "#Marques" ).find(':selected').data('type');
	 
	 
	 
     var donnees = 'task=AffModel&id='+id+'&type='+type;	 
	 ajax_send(donnees,'','affList(data)');
	 

}
 function affList(data) {
 
 
    $('#montantBien').empty().append( data ) ;
 
 }
  
</script>