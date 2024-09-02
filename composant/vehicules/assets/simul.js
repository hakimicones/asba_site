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
			
			 console.log(capacite+"  "+ tva+"  "+  taux+"  "+  nbEcheance)
			 
		 
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
        function updateCalc(apportIschanged,tva,t){      
		
		 
        
            var tauxCharge = parseFloat(($("#tauxCharge").val().split("#")[0]/100));
            var tauxChargeModif = parseFloat(($("#tauxCharge").val().split("#")[0]/100)/12);
            var nbEcheance = parseFloat($("#nbEcheance").val());
            var capaciteNette = parseFloat($("#capaciteNette").val());
			
			
			
			
			
			
            montantBien = parseFloat($("#montantBien").val());
			
			console.log(capaciteNette+" "+tauxCharge+" "+nbEcheance+" "+montantBien);

            var str =  $("select[name=tauxCharge]").find(":selected").text();
            
            var stva  = tva;
           
        	
            // console.log('tauxChargeModif : '+tauxChargeModif);    
			// console.log('tauxCharge : '+tauxCharge);  
            //  Control de Capacité
			
            if (!isNaN(parseFloat($("#salaireEmp").val().split(".").join(""))) && !isNaN(parseFloat($("#salaireCoEmp").val().split(".").join("")))) {
             
			$("#salaireCumule").val(parseFloat(parseFloat($("#salaireEmp").val().split(".").join("")) + parseFloat($("#salaireCoEmp").val().split(".").join(""))).toFixed(2));
                
			//	alert($("#salaireCumule").val());
				 if (t) {
				// alert(t);
				var salCum = $("#salaireCumule").val()
				if ( salCum < 50001 ) {$("#tauxCapacite").val(30);  alert(1) }
				if ( salCum > 50000 && salCum < 100000 ) { $("#tauxCapacite").val(40) }
				if ( salCum > 100000 ) { $("#tauxCapacite").val(50);  }
				} else {
				
				 $("#tauxCapacite").val(30);
				
				} 
				
				$("#capaciteBrute").val(parseFloat(parseFloat($("#salaireCumule").val() ) * parseFloat($("#tauxCapacite").val()  / 100)).toFixed(2));
				
				console.log(' capaciteBrute  : '+$("#capaciteBrute").val());
				 
				

                $("#salaireCumule").attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
                $("#capaciteBrute").attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
				
				
				
            }
            else {
                $("#salaireCumule").val("");
                $("#capaciteBrute").val("");
                $("#salaireCumule").attr('style', "border-radius: 0px; border:#FF0000 1px solid;");
                $("#capaciteBrute").attr('style', "border-radius: 0px; border:#FF0000 1px solid;");
            }
   			
			
            if (!isNaN(parseFloat($("#capaciteConsomm").val() )) && !isNaN(parseFloat($("#capaciteCautionConsomm").val() )) && !isNaN(parseFloat($("#capaciteBrute").val() ))){
                $("#capaciteNette").val(parseFloat(parseFloat($("#capaciteBrute").val() ) -(parseFloat($("#capaciteConsomm").val() ) + parseFloat($("#capaciteCautionConsomm").val() ))).toFixed(2));
				
				
				
				 
				 
				  
                $("#capaciteNette").attr('style', "border-radius: 0;  box-shadow: none; border:#d2d6de 1px solid;");
				
				
				 console.log(capaciteNette+" "+tauxCharge+" "+nbEcheance+" "+montantBien);
				
				
            }
            else{
                $("#capaciteNette").val("");
                $("#capaciteNette").attr('style', "border-radius: 0px; border:#FF0000 1px solid;");
            }
            console.log(capaciteNette+" "+tauxCharge+" "+nbEcheance+" "+montantBien);
            if(!isNaN(capaciteNette) && !isNaN( tauxCharge) && !isNaN(nbEcheance) && !isNaN(montantBien)) {
                 
                if (apportIschanged) {
					 
                    montantcredit = montantBien - parseFloat($("#apportPersonnel").val().split(".").join(""));
					 
                }
				
                else {
				 
                    var finMax = montantBien * ($("#tauxMaxFin").val()/100);
                    var mntFinancemet_first;
                    mntFinancemet_first = va(capaciteNette, tva, tauxCharge, nbEcheance);
					 
 
                    if (mntFinancemet_first < finMax) {
                        montantcredit = mntFinancemet_first;
                    }
                    else {
                        montantcredit = finMax;
                    }
 					 
                    apport = parseFloat(Math.round((montantBien - montantcredit) * 100) / 100);
                    $("#apportPersonnel").val(separateurMilliers(apport));
					$("#apportMinimum").val( $("#apportPersonnel").val());
                    $("#apportMin").text("");
                    $("#apportMin").text("Apport Min : " + separateurMilliers(apport));
                    $("#pourcentFin").text("");
                    $("#pourcentFin").text("" + parseFloat((Math.round(montantcredit * 100)/ montantBien) * 100 /100).toFixed(2) + "%");

                }
				
				
                if (!isNaN(montantcredit))
                    $("#montantCredit").val(separateurMilliers(parseFloat(Math.round(montantcredit * 100) / 100).toFixed(2)));

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
				
                $("#montantEcheance").val(separateurMilliers(parseFloat(Math.round(mtEcheance_ttc * 100)/100).toFixed(2)));
                var montantRembour = total_tva + total_marge + total_pricipal;
                if(!isNaN(montantRembour))
                    $("#montantRembour").val(separateurMilliers(parseFloat(Math.round(montantRembour * 100)/100).toFixed(2)));
                if(!isNaN(total_marge))
                    $("#montantMarget").val(separateurMilliers(parseFloat(Math.round(total_marge * 100)/100).toFixed(2)));
                if(!isNaN(total_tva))
                    $("#montantTva").val(separateurMilliers(parseFloat(Math.round(total_tva* 100)/100).toFixed(2)));
                if(!isNaN(total_marge))
                    $("#totalMarge").val(separateurMilliers(parseFloat(Math.round(total_marge* 100)/100).toFixed(2)));
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
	var label = '<label '+pos+' for="'+lib+'"   class="col-md-3 control-label">'+lib+'</label>';
    var html = '';      
	
	if (lg!='ar'|| te ) {html = label +div ;} else{ html = label +div ; } 
	
	return '<div '+pos+' class="row  '+css1+' ">'+html+" "+'</div>' ;  
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
	var label = '<label '+pos+' for="'+lib+'"   class="col-md-3 control-label">'+lib+'</label>';
    var html = '';      
	
	if (lg!='ar'|| te ) {html = label +div ;} else{ html = label +div ; } 
	
	return '<div '+pos+' class="row  '+css1+' ">'+html+'</div> ' ; ;
	}
	
// <input id="nbEcheance" data-slider-id="ex1Slider" type="text" data-slider-min="12" data-slider-max="60" data-slider-step="1" data-slider-value="12"/>	

function affSlider(nom,lib,lg,css,tag,min,max) {
	 
	var pos = '';
	var rtl = '';
	
	if (lg!='ar'|| te ) { pos = '';} else{ pos = 'style="text-align:left"'; rtl1 = 'style="direction:rtl"';} 
	var div  ='<div class="col-md-9">';
	div +='<input '+tag+'  class="form-control '+css+'"  data-slider-id="ex1Slider" type="text" ';
 	div +=' data-slider-min="'+min+'" data-slider-max="'+max+'" data-slider-step="1" data-slider-value="'+min+'"/> </div>';
	
	
	var label = '<label '+pos+' for="'+lib+'"   class="col-md-3 control-label">'+lib+'</label>';
    var html = '';      
	
	if (lg!='ar' || te ) {html = label +div ;} else{ html = label +div ; } 
	
	return '<div '+pos+' class="row">'+html+'</div> ' ; ;
	}

	
/*************************************************/	
	
/**************************/
function affRubSelectAn(nom,lib,maxi,lg,tag,def) {
	
	if (lg.toLowerCase()!='ar') { pos = 'style="text-align:right;"';} else{pos = 'style=""'; } 
	
	var div  = '<div class="col-md-9"><select '+tag+' class="form-control hasValue " id="'+nom+'" name="'+nom+'">'
	var label = '<label '+pos+' for="'+lib+'"  class="col-md-3 control-label">'+lib+'</label>';
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
	
	return '<div class="row">'+html+'</div> ' ;
}
/***********************/



function affRubSelect(nom,lib,option,lg,tag,css) {
	var pos = ''
	 if (lg!='ar' || te ) { pos = '';} else{pos = 'style="text-align:left;"'; } 
	
	var div  = '<div class="col-md-9"><select '+tag+' class="form-control hasValue" id="'+nom+'" name="'+nom+'">'
	var label = '<label '+pos+' for="'+lib+'"  class="col-md-3 control-label">'+lib+'</label>';
    var opt = '';
   
	
	
	
    for (var i = 0; i < option.length; i++) {
	
     div  +='<option value="'+option[i].taux+'">'+option[i].libelle+' </option>';
		
}
	
    
   // label +='<option value="9.5">{financement vehicule} </option>  ';    
	
	
	
    div  +='</select></div> ';
	
	if (lg!='ar'  || te ) {html = label +div ;} else{ html = div +label }
	
	return '<div class="row '+css+'">'+html+'</div> ' ;
}


function affRubHidden(nom , val,tag ) {
	
	return '<input class="form-control hasValue" id="'+nom+'"  name="'+nom+'" value="'+val+'" '+tag+'  type="hidden">';
	
	
	}