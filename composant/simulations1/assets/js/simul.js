 function separateurMilliers(a){  

var myMon = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'DZD' }).format(a);
 

return myMon.replace("DZD","");
}

//******************************
 


/****************************************/

        // fct trim utilisé da,s séparateur miliers
        function trim(nb) {
            var res = "";
            var nbr = nb.toString();
            var n = nbr.length;
            for (var i = 0; i < n; i++) {
                if (nbr.substring(i, i + 1) != " ") {
                    res += nbr.substring(i, i + 1)
                }
            }
            return res;
        }

        function strpos(haystack, needle, offset) {
            var i = (haystack + "").indexOf(needle, (offset || 0));
            return i === -1 ? false : i
        }

        // fonction pour s�parer les miliers
        function separateurMilliers1(val) {
            
            
            return val;
        }

        function vpm(taux, npm, va, vc, type){
            var tauxAct = Math.pow(1 + taux, -npm);
            if((1 - tauxAct) == 0)
                return 0;
            var vpm = parseFloat( (va + vc * tauxAct) * taux / (1 - tauxAct) ) / (1 + taux * type);
            return -vpm;
        }

        // la fonction va est utilisé pour le calcul inversé 
        // on donne l'apport pour récupérer l'echéance
        function va (capacite, tva, taux, nbEcheance){
			
			 ////console.log(capacite+"  "+ tva+"  "+  taux+"  "+  nbEcheance)
			 
		 
            var mnt  = 1;
            var step = 2;
            var i = 0;
            var btw = false;
			
			
            var vpmval = -vpm(taux/12, nbEcheance, mnt, 0, 0) + (mnt * taux/12 * tva);
            while (vpmval != capacite && i < 1000 ){
                vpmval = -vpm(taux/12, nbEcheance, mnt, 0, 0) + (mnt * taux/12 * tva);                
                if(vpmval < capacite){
                    mnt = mnt + step;
                    if(! btw)
                        step = step * 2;
                }
                else if(vpmval > capacite){
                    step = step / 2;
                    mnt = mnt - step;
                    btw = true;
                }                
                i++;
            }
            return mnt;
        }        

        $(document).on('change keyup','#montantCredit',function(e) {
																
            e.preventDefault();
            if ($(e.currentTarget).val() != "") {
                $(e.currentTarget).val($(e.currentTarget).val());                
            }
        });

        var apport;
        var montantcredit;
        var montantBien;
        var tva;

    // function pour calculer la simulation
    function updateCalc(apportIschanged,tva,t,ind=""){    
	
 ////console.log( );
 
 
            
		
            var tauxCharge = parseFloat(($("#tauxCharge"+ind).val().split("#")[0]/100));
            var tauxChargeModif = parseFloat(($("#tauxCharge"+ind).val().split("#")[0]/100)/12);
            var nbEcheance = (isNaN(  parseFloat( $("#nbEcheance"+ind).val() )  ) ) ? 1 : parseFloat($("#nbEcheance"+ind).val() );
            var capaciteNette = parseFloat($("#capaciteNette"+ind).val());	
						
            montantBien = parseFloat( $("#montantBien"+ind ).val());
			
		//	 //console.log("capNette "+capaciteNette+" "+tauxCharge+" "+nbEcheance+" "+montantBien);

            var str =  $("select[name=tauxCharge]").find(":selected").text();
            
            var stva  = tva;           
        	
            ////console.log('tauxChargeModif : '+tauxChargeModif);    
			// ////console.log('tauxCharge : '+tauxCharge);  
            //  Control de Capacité
			
			
			
			// console.log('salaireEmp  : '+$("#salaireEmp"+ind).val());
			// console.log('salaireCoEmp  : '+$("#salaireCoEmp"+ind).val() );
			//console.log('  : '+);
 			//console.log('  : '+);
			
            if (!isNaN(parseFloat($("#salaireEmp"+ind).val().split(".").join(""))) && !isNaN(parseFloat($("#salaireCoEmp"+ind).val().split(".").join("")))) {
				
				
				var salaireEmp    = $("#salaireEmp"+ind).val().split(".").join("");
				var salaireCoEmp  = $("#salaireCoEmp"+ind).val().split(".").join("");
				var salCum = parseFloat(salaireEmp ) + parseFloat(salaireCoEmp );
			//	console.log('salaireEmp  : '+ salaireEmp );
//			    console.log('salaireCoEmp  : '+salaireCoEmp );


			$("#salaireCumule"+ind).val(salCum );
                
				 if (t) {
				// alert(t);
				
		//	console.log(salCum);
				
				
				if ( salCum < 50001 ) {$("#tauxCapacite"+ind).val(30);   }
				if ( salCum > 50000 && salCum < 100000 ) { $("#tauxCapacite"+ind).val(40);   }
				if ( salCum > 99999 ) { $("#tauxCapacite"+ind).val(50);    }
				
				
			 
				
				
				} else {
				
				 $("#tauxCapacite"+ind).val(30);
				 
				 
				
				} 
			//	console.log( $("#tauxCapacite"+ind).val());
				
				var salaireCumule = parseFloat($("#salaireCumule"+ind).val() ) ;
				var tauxCapacite  =  parseFloat(  $("#tauxCapacite"+ind).val()  / 100  ) 
				var capaciteBrute = salaireCumule * tauxCapacite 
				
				 console.log('capaciteBrute : '+capaciteBrute    );
				
				$("#capaciteBrute").val(capaciteBrute );
				
				// console.log(' capaciteBrute  : '+$("#capaciteBrute"+ind).val() + '  ' + capaciteBrute);
				 
				

                $("#salaireCumule"+ind).attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
                $("#capaciteBrute"+ind).attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
				
				
				
            }
            else {
				
                $("#salaireCumule"+ind).val("");
                $("#capaciteBrute"+ind).val("");
                $("#salaireCumule"+ind).attr('style', "border-radius: 0px; border:#FF0000 1px solid;");
                $("#capaciteBrute"+ind).attr('style', "border-radius: 0px; border:#FF0000 1px solid;");
				
            }
			
			
			   capaciteBrute  = $("#capaciteBrute").val();
				var capaciteConsomm  		= parseFloat(  $("#capaciteConsomm"+ind).val()  ) ;
				var capaciteCautionConsomm	= parseFloat($("#capaciteCautionConsomm"+ind).val());
				var capaciteNette 			= capaciteBrute - capaciteConsomm + capaciteCautionConsomm
				
				
				
   			 console.log(capaciteBrute + ' '+  capaciteConsomm + '  '+ capaciteCautionConsomm );
			
			////console.log(capaciteBrute   );
			
            if (!isNaN( capaciteConsomm) && !isNaN( capaciteCautionConsomm ) && !isNaN( capaciteBrute )){
				
				
				
				 
             $("#capaciteNette"+ind).val( capaciteNette   );
				
				
			 
				 
				 
				  
                $("#capaciteNette"+ind).attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
				
				
				 ////console.log(capaciteNette+" / "+tauxCharge+" "+nbEcheance+" "+montantBien);
				
				
            }
            else{
                $("#capaciteNette"+ind).val("");
                $("#capaciteNette"+ind).attr('style', "border-radius: 0px; border:#FF0000 1px solid;");
            }
			
			
			
            //console.log(capaciteNette+" "+tauxCharge+" "+nbEcheance+" "+montantBien);
            if(!isNaN(capaciteNette) && !isNaN( tauxCharge) && !isNaN(nbEcheance) && !isNaN(montantBien)) {
				
				
				
                 
                if (apportIschanged) {
					 
                    montantcredit = montantBien - parseFloat($("#apportPersonnel"+ind).val().split(".").join(""));
					 
                }
				
                else {
				 
                    var finMax = montantBien * ($("#tauxMaxFin"+ind).val()/100);
                    var mntFinancemet_first;
                    mntFinancemet_first = va(capaciteNette, tva, tauxCharge, nbEcheance);
					 
 
                    if (mntFinancemet_first < finMax) {
                        montantcredit = mntFinancemet_first;
                    }
                    else {
                        montantcredit = finMax;
                    }
 					 
                    apport = parseFloat(Math.round((montantBien - montantcredit) * 100) / 100);
                    $("#apportPersonnel"+ind).val(separateurMilliers(apport));
					$("#apportMinimum"+ind).val( $("#apportPersonnel").val());
                    $("#apportMin"+ind).text("");
                    $("#apportMin"+ind).text("Apport Min : " + separateurMilliers(apport));
                    $("#pourcentFin"+ind).text("");
                    $("#pourcentFin"+ind).text("" + parseFloat((Math.round(montantcredit * 100)/ montantBien) * 100 /100).toFixed(2) + "%");

                }
				
				
                if (!isNaN(montantcredit))
                    $("#montantCredit"+ind).val(separateurMilliers(parseFloat(Math.round(montantcredit * 100) / 100).toFixed(2)));

                var mtEcheance_ht = -vpm(tauxChargeModif, nbEcheance, montantcredit, 0, 0);
				
				
				
                var marge = montantcredit * tauxCharge * 1 / 12;
                var tva_mensuel = marge * tva;
                var mtEcheance_ttc = tva_mensuel + mtEcheance_ht;

                var capitalInit = montantcredit;
                var margeCalc = 0;
                var principal = 0;
                var total_marge = 0;
                var total_pricipal = 0;
                var total_tva = 0;
                var tvaCalc;

                // Calcul des tautaux TVA,Marge,Rembour

                for (var i = 0; i < nbEcheance; i++) {
                    margeCalc = capitalInit * tauxCharge * 1 / 12;
                    tvaCalc = tva * margeCalc;
                    principal = mtEcheance_ht - margeCalc;
                    total_pricipal = total_pricipal + principal;
                    total_tva = total_tva + tvaCalc;
                    total_marge = total_marge + margeCalc;
                    capitalInit = capitalInit - principal;
                }
            }

            // formatage des Mnts
			 
            if(!isNaN(mtEcheance_ttc)){
				
                $("#montantEcheance"+ind).val(separateurMilliers(parseFloat(Math.round(mtEcheance_ttc * 100)/100).toFixed(2)));
                var montantRembour = total_tva + total_marge + total_pricipal;
                if(!isNaN(montantRembour))
                    $("#montantRembour"+ind).val(separateurMilliers(parseFloat(Math.round(montantRembour * 100)/100).toFixed(2)));
                if(!isNaN(total_marge))
                    $("#montantMarget"+ind).val(separateurMilliers(parseFloat(Math.round(total_marge * 100)/100).toFixed(2)));
                if(!isNaN(total_tva))
                    $("#montantTva"+ind).val(separateurMilliers(parseFloat(Math.round(total_tva* 100)/100).toFixed(2)));
                if(!isNaN(total_marge))
                    $("#totalMarge"+ind).val(separateurMilliers(parseFloat(Math.round(total_marge* 100)/100).toFixed(2)));
            }

        }
		
		
	 
	/**************************/
	var te = false ; 
	if(window.matchMedia("(max-width:640px)").matches)  {te = true  ;}  
 
function affRubTag(cont,lib,lg,tag,css,css1) {
	if (css=='') {css = ' hasValue hasSep'}
	var pos = '';
	var rtl = '';
	if (tag == 'undefined') tag = '';
	if (css1 == 'undefined') css = '';
	//css1 = (css1 <> 'undefined')?css1:'';
	if (css == 'undefined') css1 = '';
	if (lg!='ar'|| te ) { pos = '';} else{ pos = 'style=""'; rtl1 = 'style="direction:rtl"';} 
	var div  ='<div '+tag+' class="col-md-9 w100">'+cont+'</div>';
	var label = '<label '+pos+' for="'+lib+'"   class="col-md-2 control-label">'+lib+'</label>';
    var html = '';      
	
	if (lg!='ar'|| te ) {html = label +div ;} else{ html = label +div ; } 
	
	return '<div '+pos+' class="row  form-group '+css1+' ">'+html+" "+'</div>' ;  
	}


function affRubTexte(nom,lib,lg,tag,css,css1) {
	
	if (css=='') {css = ' hasValue hasSep'}
	var pos = '';
	var rtl = '';
	if (tag == 'undefined') tag = '';
	if (css1 == 'undefined') css = '';
	//css1 = (css1 <> 'undefined')?css1:'';
	if (css == 'undefined') css1 = '';
	if (lg!='ar'|| te ) { pos = '';} else{ pos = 'style=""'; rtl1 = 'style="direction:rtl"';} 
	var div  ='<div class="col-md-9"><input '+tag+' class="form-control '+css+'" id="'+nom+'" name="'+nom+'" type="text"></div>';
	var label = '<label '+pos+' for="'+lib+'"   class="col-md-2 control-label">'+lib+'</label>';
    var html = '';      
	
	if (lg!='ar'|| te ) {html = label +div ;} else{ html = label +div ; } 
	
	return '<div '+pos+' class="row form-group '+css1+' ">'+html+'</div> ' ; ;
	}
	
// <input id="nbEcheance" data-slider-id="ex1Slider" type="text" data-slider-min="12" data-slider-max="60" data-slider-step="1" data-slider-value="12"/>	

function affSlider(nom,lib,lg,css,tag,min,max) {
	 
	var pos = '';
	var rtl = '';
	
	if (lg!='ar'|| te ) { pos = '';} else{ pos = 'style="text-align:left"'; rtl1 = 'style="direction:rtl"';} 
	var div  ='<div class="col-md-9">';
	div +='<input '+tag+'  class="form-control '+css+'"  data-slider-id="ex1Slider" type="text" ';
 	div +=' data-slider-min="'+min+'" data-slider-max="'+max+'" data-slider-step="1" data-slider-value="'+min+'"/> </div>';
	
	
	var label = '<label '+pos+' for="'+lib+'"   class="col-md-2 control-label">'+lib+'</label>';
    var html = '';      
	
	if (lg!='ar' || te ) {html = label +div ;} else{ html = label +div ; } 
	
	return '<div '+pos+' class="row form-group ">'+html+'</div> ' ; ;
	}

	
/*************************************************/	
	
/**************************/
function affRubSelectAn(nom,lib,maxi,lg,tag,def , css) {
	
	if (lg.toLowerCase()!='ar') { pos = 'style="text-align:right;"';} else{pos = 'style=""'; } 
	
	var div  = '<div class="col-md-9"><select '+tag+' class="form-control '+css+' " id="'+nom+'" name="'+nom+'">'
	var label = '<label '+pos+' for="'+lib+'"  class="col-md-2 control-label">'+lib+'</label>';
    var opt = '';
   
	
	var n=0;
	
    for (var i = 12; i < maxi+1 ; i=i+12) {
	n++;
	selected = (i==def)?'selected':'';
     div  +='<option value="'+i+'" ' +selected+'>'+ n  +'  </option>';
		
}
	
    
   // label +='<option value="9.5">{financement vehicule} </option>  ';    
	
	
	
    div  +='</select></div> ';
	
	if (lg.toLowerCase()!='ar'  || te ) {html = label +div ;} else{ html =label +div ; }
	
	return '<div class="row form-group">'+html+'</div> ' ;
}
/***********************/



function affRubSelect(nom,lib,option,lg,tag,css) {
	var pos = ''
	 if (lg!='ar' || te ) { pos = '';} else{pos = 'style="text-align:left;"'; } 
	
	var div  = '<div class="col-md-9"><select '+tag+' class="form-control hasValue" id="'+nom+'" name="'+nom+'">'
	var label = '<label '+pos+' for="'+lib+'"  class="col-md-2 control-label">'+lib+'</label>';
    var opt = '';
   
	
	
	
    for (var i = 0; i < option.length; i++) {
	
     div  +='<option value="'+option[i].taux+'">'+option[i].libelle+' </option>';
		
}
	
    
   // label +='<option value="9.5">{financement vehicule} </option>  ';    
	
	
	
    div  +='</select></div> ';
	
	if (lg!='ar'  || te ) {html = label +div ;} else{ html = div +label }
	
	return '<div class="row form-group '+css+'">'+html+'</div> ' ;
}


function affRubHidden(nom , val,tag ) {
	
	return '<input  id="'+nom+'"  name="'+nom+'" value="'+val+'" '+tag+'  type="hidden">';
	
	
	}