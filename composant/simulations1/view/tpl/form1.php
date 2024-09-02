 
 
 
		 
			<div id="simulation2"  >
			
			
			
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


 
	var html = ' ';
	
	
 
   //affRubTexte(nom,lib,lg,tag,css,css1)
	 
	html += affRubTexte('montantBien1','{prix bien}','{lg}','' ,'isValue',''); 
 
 
     var options = new Array( new taux('{financement dar al salam epargnant}',"{d_t1}" ),new taux('{financement dar al salam epargnant dom }',"{d_t2}"  ) ,new taux('{financement dar al salam non epargnant}',"{d_t3}"  ) );
 
    // html +=affRubSelect('tauxCharge','{marge}',options,'{lg}'); 
	 
	 html +=affRubHidden('tauxCharge1' , '{d_t1}','readonly="true"' );
     html +=affRubHidden('sanstva1' , '1','readonly="true"' ); 
   
    html += affRubTexte('salaireEmp1','{salaire emprunteur}','{lg}','' ,'isValue'); 
	
	html += affRubTexte('salaireCoEmp1','{salaire co-emprunteur}','{lg}','' ,'isValue'); 
   
  	//html += affRubTexte('salaireCumule','{salaire Cumule}','{lg}','readonly="true"' ,' hasValue hasSep'); 
   html +=affRubHidden('salaireCumule1','0','readonly="true"' );
 
    html +=affRubHidden('tauxCapacite1' , '30','readonly="true"' );   
	html +=affRubHidden('capaciteBrute1' , '','readonly="true"' );
    html +=affRubHidden('capaciteConsomm1' , '0','readonly="true"' );               
    html +=affRubHidden('capaciteCautionConsomm1' , '0','readonly="true"' );    
	
	html +=affRubHidden('capaciteNette1' , '30','readonly="true"' ); 
	    
  
   	html +=affRubHidden('tauxMaxFin1' , '80','readonly="true"' ); 
    
	//html += affRubTexte('nbEcheance','{Nombre d echeances}','{lg}','data-slider-min="60" data-slider-max="300" data-slider-step="1" data-slider-value="60" data-slider-selection="after" data-slider-tooltip="show"' ,' hasValue slider nb_ech'); 
	
	//html +=affSlider('nbEcheance','{Nombre d echeances}','{lg}','hasValue slider','id="nbEcheance"',60,300) 
	
	html +=affRubSelectAn( "sliderNb1",'{Nombre d echeances}',300,'{lg}','id="nbEcheance1" name="nbEcheance"',12,  'isValue','' );
	
	
	html += affRubTexte('apportPersonnel1','{participation Client}','{lg}','readonly="true"' ,'hasSep'); 
	
 
	
   
            
     
	
 
	
	html +='<div class="form-group">';
	 
    html += affRubTexte('montantEcheance1','{montant echeance}','{lg}','readonly="true"' ,'Value',''); 
	html +=affRubHidden('montantCredit1','0','readonly="true"' );
    //html += affRubTexte('montantCredit','{montant a financer }','{lg}','readonly="true"' ,''); 
                   
     
    html +=' <span class="help-block" id="pourcentFin"></span>';
    html +='  </div>';
               



    html +=' <div class="form-group">';
    html +='<div class="col-md-10">';
    html +=' <input class="form-control" readonly="true" id="montantRembour" name="montantRembour" type="hidden">';
    html +='</div></div>';
                

    html +='<div class="form-group">';
    html +='<div class="col-md-10">';
    html +='<input class="form-control" readonly="true" id="montantMarget1" name="montantMarget" type="hidden">';
    html +='</div> </div>';
               

    html +='<div class="form-group">    ';                
    html +=' <div class="col-md-10">';
    html +='<input class="form-control" readonly="true" id="montantTva1" name="montantTva" type="hidden">';
    html +='</div>';
    html +='</div>   ';             
    html +='<div class="MessageBas col-md-12">{message7}<br>';
    html +=' {message8}</div>';
	

	 	
	     
	/***************************/
	
	$('#simulation2').html(html) ;
	  
	
	 function taux(lib,taux ) {
		  this.libelle =lib;
		  this.taux=taux;
		 
		}
	
	 
function info() { 

  // alert(val()); 
  var t = $('#tauxCharge').find(':selected').attr("data-max") ;
   
   $('#tauxMaxFin').val(t);
   }
   	
	$(document).on('blur change','.isValue',function(e)  {
            e.preventDefault();
			 
         //   console.log(this.id);
            updateCalc(false,{tva},true,1);
			
			 
        });
		
	 

       

        $(document).on('blur change','.hasUpdate',function(e)  {
            e.preventDefault();
            if(apport != null && parseFloat($(this).val().split(" ").join("")) >= apport && parseFloat($(this).val().split(" ").join("")) <= montantBien){
                $(this).attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
                //update mntcredit && echeance
                updateCalc(true,{tva},true,1);
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


 
 
  
</script>