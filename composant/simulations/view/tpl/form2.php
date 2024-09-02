 
 
 
		 
			<div id="simulation3"  >
			
			
			
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
   
   
        {listevehicules1}
	
	 
	
	//html +=affRubHidden('montantBien' , '{prix}','readonly="true"' );
	
	
	html +=affRubHidden('tauxCharge2' , '10.5','readonly="true"' );
	
	html +=affRubTexte('salaireEmp2','{salaire emprunteur}','{lg}', 'onblur="num(this)"',' hasValue2'); 
	            
    html +=affRubTexte('salaireCoEmp2','{salaire co-emprunteur}','{lg}', 'value="0" onblur="num(this)" ','hasValue2'); 


    html +=affRubHidden('salaireCumule2','0','readonly="true"' );
   // html +=affRubTexte('salaireCumule','{salaire Cumule}','{lg}','readonly="true"','',' hasValue2');  
	
	html +=affRubHidden('tauxCapacite2' , '30','readonly="true"' );   
	html +=affRubHidden('capaciteBrute2' , '','readonly="true"' );
	
	html +=affRubHidden('capaciteConsomm2' , '0','readonly="true"' );
	html +=affRubHidden('capaciteCautionConsomm2' , '0','readonly="true"' );
	
		                                    
  
		html +=affRubHidden('capaciteNette2' , '','readonly="true"' );
	
	html +=affRubHidden('tauxMaxFin2' , '100','readonly="true"' );


	/*  
	 html +=affRubTexte('sliderNb','{Nombre d echeances}','{lg}',' data-slider-id="sliderNb" id="nbEcheance" name="nbEcheance" type="text" data-slider-min="24" data-slider-max="60" data-slider-step="1" data-slider-value="24" data-slider-selection="after" data-slider-tooltip="show"',' hasValue2 slider nb_ech' ); 
*/
	html +=affRubSelectAn( "sliderNb2",'{Nombre d echeances}',60,'{lg}','id="nbEcheance2" name="nbEcheance"', 60 , 'isValue2 hasValue2' );
	//html +=affRubTexte('apportMinimum','{participation Client}','{lg}','readonly="true"',' no-data' );
 	html +=affRubTexte('apportPersonnel2','{participation Client}','{lg}','readonly="true"','hasData' ); 
	 
	 html +='<span class="help-block no-data" id="apportMin"></span>';
 


   html +='<div class="form-group">';
    	html +=affRubTexte('montantEcheance2','{montant echeance}','{lg}','readonly="true"' ,''); 
	
	
	html +=affRubHidden('montantCredit2','0','readonly="true"' );
	//html +=affRubTexte('montantCredit','{montant a financer }','{lg}','readonly="true"' ,' hasValue2 hasSep'); 

	html +='<span class="help-block" id="pourcentFin2"></span>';	
	html +='  </div>';	
		
    


   html +=' <div class="form-group">'; 
   html +=affRubHidden('montantRembour2' , '100','readonly="true"' );
   html +='</div>';
   
   
   html +=' <div class="form-group">';
   html +=affRubHidden('montantMarget2' , '0','readonly="true"' );
   html +='</div>';
   
 
   html +='<div class="form-group"> '; 
   html +=affRubHidden('montantTva2' , '0','readonly="true"' );
   html +='</div>';
   
    html +='<div class="MessageBas col-md-12">{message7}<br>';
    html +=' {message8}</div>';
   
   /*            
   html +='<div class="col-md-10">';
   html +='{message7}</div>';

*/	 
	
	$('#simulation3').html(html) ;

function info() { 

  // alert(val()); 
  var t = $('#tauxCharge2').find(':selected').attr("data-max") ;
   
   $('#tauxMaxFi2n').val(t);
   }
   	
	$(document).on('change keyup','.hasValue2',function(e)  {
            e.preventDefault();
			 
            
            updateCalc(false,{tva},tsu,2);
        });
		
		$(document).on('change keyup','.hasData',function(e)  {
            e.preventDefault();
			 
            
            updateCalc(false,{tva},tsu,2);
        });

        $(document).on('change keyup','.hasTaux',function(e)  {
            e.preventDefault();
            $(this).val($(this).val());
             
            updateCalc(false,{tva},tsu,2);
        });


        $(document).on('change keyup','.hasUpdate',function(e)  {
            e.preventDefault();
            if(apport != null && parseFloat($(this).val().split(" ").join("")) >= apport && parseFloat($(this).val().split(" ").join("")) <= montantBien){
                $(this).attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
                //update mntcredit && echeance
                updateCalc(false,{tva},tsu,2);
            }
            else {
                $(this).attr('style', "border-radius: 0px; border:#FF0000 1px solid;");
                $("#montantRembour2").val("");
                $("#montantMarget2").val("");
                $("#montantTva2").val("");
                $("#totalMarge2").val("");
                $("#montantEcheance2").val("");
            }

        });


function affModel2(){

     var id		= $( "#Marques2" ).val();
	 var type   = $( "#Marques2" ).find(':selected').data('type');
 
	 
     var donnees = 'task=AffModel&id='+id+'&type='+type;	 
	 ajax_send(donnees,'','affList2(data)');
	 

}
 function affList2(data) {
 
 console.log(data)
    $('#montantBien2').empty().append( data ) ;
 
 }
 
</script>