<section id="tools" class="ppp">
 
	  	 
	 
		 
		
		 
		
		<div id="simul1" class="tab-pane fade  active in">
		
		 
		<div class="col-md-12 btn-simul">
		<a class="btn " onclick="aff(1)"><img src="images/btn-tayssir-21.png" id="btn-tayssir" alt="{facilites}"  width="80"  /></a> 
		<a class="btn  " onclick="aff(2)"> <img src="images/btn-dar-salam-2.png" id="btn-dar" alt="{dar salam}" width="80"   /> </a>
		<a class="btn  " href="{lg}/vehicules/simulation-{pg}-0.html"> <img src="images/autre-sim-{lg}-2.png" alt="{autresim}" width="80" /> </a>
		  
		</div>
		<br /><br />
			<div id="ContactForm">
			 
			</div>	
		<script src="assets/simul.js" type="text/javascript"></script>
		 <script>
		 /***********/
		 //******************************
function num(e) {

	 


	 		var a = e.value 
	 		a = a.replace(",00","");
	 		a = a.replace('.',""); 
	 		a = a.replace('.',"");
	 		a = a.split(' ');
 	

	 		var b = "";
	 		b= a ;
 		  
 		console.log("Valeur de "+e.name+" : "+ b) ;

 		 
 		 e.value = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'DZD' }).format(b).replace("DZD","") ;


		 }


/****************************************/
		 
		 
		 

	$("#btn-tayssir").click(function() {   $("#btn-tayssir").attr("src","images/btn-tayssir-21.png");   $("#btn-dar").attr("src","images/btn-dar-salam-2.png");       });
    $("#btn-dar").click(function() { 	   $("#btn-dar").attr("src","images/btn-dar-salam-21.png");  $("#btn-tayssir").attr("src","images/btn-tayssir-2.png");         });
	var tsu  = false ;
	
	//*****************************************//
	
	function affSimul1() {
	var html = ''; 
    var options = new Array(  new taux('{financement vehicule}',"{t_t1}"  ) , new taux('{financement equipement}',"{t_t2}" ));
  
	
 
	html +=affRubTag('{marques}','{marque}','{lg}','id="marques-div"',' form-control  hasValue ');

 	html +=affRubTag('{vehicule}','{prix auto}','{lg}','id="vehicules-div"',' hasValue ');
//	html +=affRubSelect('tauxCharge','{marge}',options,'{lg}','','no-data' );   
	
	html +=affRubHidden('tauxCharge' , '{t_t1}','readonly="true"' );
	
	html +=affRubTexte('salaireEmp','{salaire emprunteur} 1','{lg}', 'onblur="num(this)"',' hasValue'); 
	            
    html +=affRubTexte('salaireCoEmp','{salaire co-emprunteur}','{lg}', 'value="0" onblur="num(this)" ','hasValue'); 


    html +=affRubHidden('salaireCumule','0','readonly="true"' );
   // html +=affRubTexte('salaireCumule','{salaire Cumule}','{lg}','readonly="true"','',' hasValue');  
	
	html +=affRubHidden('tauxCapacite' , '30','readonly="true"' );   
	html +=affRubHidden('capaciteBrute' , '','readonly="true"' );
	
	html +=affRubHidden('capaciteConsomm' , '0','readonly="true"' );
	html +=affRubHidden('capaciteCautionConsomm' , '0','readonly="true"' );
	
		                                    
  
		html +=affRubHidden('capaciteNette' , '','readonly="true"' );
	
	html +=affRubHidden('tauxMaxFin' , '80','readonly="true"' );


	/*  
	 html +=affRubTexte('sliderNb','{Nombre d echeances}','{lg}',' data-slider-id="sliderNb" id="nbEcheance" name="nbEcheance" type="text" data-slider-min="24" data-slider-max="60" data-slider-step="1" data-slider-value="24" data-slider-selection="after" data-slider-tooltip="show"',' hasValue slider nb_ech' ); 


*/
	html +=affRubSelectAn( "sliderNb",'{Nombre d echeances}',60,'{lg}','id="nbEcheance" name="nbEcheance"', 60 , '{annees}','{annee}');


	html +=affRubTexte('apportPersonnel','{participation Client}','{lg}','readonly="true"' ); 
	 
	 html +='<span class="help-block no-data" style="display:none" id="apportMin"></span>';
 


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
   
               
   html +='<div class="col-md-10">';
   html +='{message7}</div>';
 
	
	$('#ContactForm').html(html) ;
	
	
	// $('.nb_ech').slider({	formatter: function(value) {alert(55);			return 'Current value: ' + value;	}});
	
	/*var slider = new Slider('.nb_ech', {
	formatter: function(value) {  
		return 'Nombre d\'echeance : ' + value;
	}
});*/
	
	}

	
	
	//**********************************//
	
	function affSimul2() {
	var html = ' ';
	
	
 
 
	 
	html += affRubTexte('montantBien','{prix bien}','{lg}','' ,''); 
 
 
     var options = new Array( new taux('{financement dar al salam epargnant}',"{d_t1}" ),new taux('{financement dar al salam epargnant dom }',"{d_t2}"  ) ,new taux('{financement dar al salam non epargnant}',"{d_t3}"  ) );
 
    // html +=affRubSelect('tauxCharge','{marge}',options,'{lg}'); 
	 
	 html +=affRubHidden('tauxCharge' , '{d_t1}','readonly="true"' );
     html +=affRubHidden('sanstva' , '1','readonly="true"' ); 
   
    html += affRubTexte('salaireEmp','{salaire emprunteur}','{lg}', '',''); 
	
	html += affRubTexte('salaireCoEmp','{salaire co-emprunteur}','{lg}','' ,''); 
   
  	//html += affRubTexte('salaireCumule','{salaire Cumule}','{lg}','readonly="true"' ,' hasValue hasSep'); 
   html +=affRubHidden('salaireCumule','0','readonly="true"' );
 
    html +=affRubHidden('tauxCapacite' , '30','readonly="true"' );   
	html +=affRubHidden('capaciteBrute' , '','readonly="true"' );
    html +=affRubHidden('capaciteConsomm' , '0','readonly="true"' );               
    html +=affRubHidden('capaciteCautionConsomm' , '0','readonly="true"' );    
	
	html +=affRubHidden('capaciteNette' , '','readonly="true"' ); 
	    
  
   	html +=affRubHidden('tauxMaxFin' , '80','readonly="true"' ); 
    
	//html += affRubTexte('nbEcheance','{Nombre d echeances}','{lg}','data-slider-min="60" data-slider-max="300" data-slider-step="1" data-slider-value="60" data-slider-selection="after" data-slider-tooltip="show"' ,' hasValue slider nb_ech'); 
	
	//html +=affSlider('nbEcheance','{Nombre d echeances}','{lg}','hasValue slider','id="nbEcheance"',60,300) 
	
	html +=affRubSelectAn( "sliderNb",'{Nombre d echeances}',300,'{lg}','id="nbEcheance" name="nbEcheance"',12,  '{annees}','{annee}' );
	
	
	html += affRubTexte('apportPersonnel','{participation Client}','{lg}','readonly="true"' ,''); 
	
 
	
   
            
     
	
 
	
	html +='<div class="form-group">';
	
    html += affRubTexte('montantEcheance','{montant echeance}','{lg}','readonly="true"' ,''); 
	html +=affRubHidden('montantCredit','0','readonly="true"' );
    //html += affRubTexte('montantCredit','{montant a financer }','{lg}','readonly="true"' ,''); 
                   
     
    html +=' <span class="help-block" id="pourcentFin"></span>';
    html +='  </div>';
               



    html +=' <div class="form-group">';
    html +='<div class="col-md-10">';
    html +=' <input class="form-control" readonly="true" id="montantRembour" name="montantRembour" type="hidden">';
    html +='</div></div>';
                

    html +='<div class="form-group">';
    html +='<div class="col-md-10">';
    html +='<input class="form-control" readonly="true" id="montantMarget" name="montantMarget" type="hidden">';
    html +='</div> </div>';
               

    html +='<div class="form-group">    ';                
    html +=' <div class="col-md-10">';
    html +='<input class="form-control" readonly="true" id="montantTva" name="montantTva" type="hidden">';
    html +='</div>';
    html +='</div>   ';             
    html +='<div class="MessageBas col-md-12">{message7}<br>';
    html +=' {message8}</div>';
	

	 	
	     
	/***************************/
	
	$('#ContactForm').html(html) ;
	  
	
	 
	
	}
		/**/
		  

 			function aff(t) {
			 
			if (t!=1) {
			tsu=true;
			affSimul2();  } 
			else { 
			affSimul1(); 
			//$("select.selectpicker").css("display","block");
			//$('.selectpicker').selectpicker();
			tsu=false;  }
			 
			}
			
			  
			/*********************/
				
	$(document).on('change keyup','.hasValue',function(e)  {
            e.preventDefault();
			 
            
            updateCalc(false,{tva},tsu);
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

		 
		 
$(document).ready(function(){
   
    
   //$("#tools .slider-horizontal [name!='sliderNb'] ").css("display","none");  
    affSimul1(); 
}); 
  


function affModel() {

    
   var id =  $('#Marques').val();
 var donnees = "task=affVehicules&id="+id  ; 
 $("#vehicules-div").empty()
ajax_send(donnees,"#vehicules-div");
$('#montantBien').selectpicker();

} 
function ajax_send(donnees,elem) {
$.ajax({
            type:'POST',
            url:'send_ajx.php?option=outils', 
            data: donnees,
            success:function(data){
			 if (data!='') {
                
				 $(elem).empty().append(data);
				 
				  
				 
				} 
            }
        });


}

function taux(lib,taux ) {
		  this.libelle =lib;
		  this.taux=taux;
		 
		}
</script> 
	</div>	
</section>
