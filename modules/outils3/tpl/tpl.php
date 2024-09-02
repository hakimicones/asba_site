<section id="tools">
	  <div class="container">
	  	<ul class="nav nav-pills nav-justified">
	  		<li role="presentation" class="active" ><a href="#simul1">{simul} <i class="fa fa-calculator" aria-hidden="true"></i></a></li>
  			<li role="presentation" ><a href="#priere"> {horraire priere} <span class="fa fa-moon-o"></span></a></li>
  			<li role="presentation" class=""><a href="#zakat">{zakat} <span class="fa fa-envira"></span></a></li>
  			
			<li role="presentation" class=""><a href="#meteo_tab">{meteo} <i class="fa fa-sun-o" aria-hidden="true"></i></a></li>
			<li role="presentation" class=""><a href="#convert">{convertion} <i class="fa fa-money" aria-hidden="true"></i></a></li>
		</ul>
		<div class="tab-content">
		<div id="priere" class="tab-pane fade priere">
			<div class="row">
			<div class="col-sm-6" style="padding-top:20px; text-align:left">
			{villes}
			</div>
			<div class="col-sm-6"><h3 id="youm" class="p_gros">    </h3></div>
			</div>
			<div id="table" class="ligne pull-right" style="margin-top:20px;"></div>
    		
		</div>
		
		<div id="zakat" class="tab-pane fade zakat">
			<h3>{zakat}</h3>
			<form action="" id="form_zakat" method="post">
			<div class="col-sm-6">
			<label for="basic-url">{zakat}</label>
		
	    		<div class="input-group">			 
				<select onchange="affData()" name="type_zakat" id="zakat_type" class="selectpicker" tabindex="-98">
				  <option value="1">{comptant}</option>
				  <option value="2">{or} </option>
				   
				</select> 
			</div>
			<div id="cash">
				<div class="input-group">
  				<input type="text" class="form-control" placeholder="{montant} " id="tot">
			</div>
			</div>
			
			<div id="or" style="display:none">
				<div class="input-group">
					<label class="zakat_label"> {poids en carat}</label>
	
					<input type="text" class="form-10" id="g24" placeholder="24">
					<input type="text" class="form-10" id="g22" placeholder="22">
					<input type="text" class="form-10" id="g21" placeholder="21">
					<input type="text" class="form-10" id="g18" placeholder="18">
				</div>		
			</div>
			<button class="btn btn-default" type="button" onclick="affZakat()"> {calcul} </button>
			<div id="mess">
			
			
			</div>
			 	
		</div>
		
		</form>
		<script>
			
			function taux(lib,taux ) {
		  this.libelle =lib;
		  this.taux=taux;
		 
		}
			function affData() {
			var v = $("#zakat_type").val();
				if (v!=1) {
				
					$("#cash").removeAttr("style").hide();
					$("#or").show();
				
				} else {
					$("#or").removeAttr("style").hide();
					$("#cash").show();
				} 
				}
			
			function affZakat() {
			
				var p24 = {p24}  /* 6800; */
				var p22 = {p22}  /*6400;*/
				var p21 = {p21}  /*66000;*/
				var p18 = {p18}  /*65000;*/
				var nis = {nis}  /*6500000;*/
				
			 	var v = $("#zakat_type").val();
				if (v!=1) {
				var g24 = $("#g24").val();
				var g22 = $("#g22").val();
				var g21 = $("#g21").val();
				var g18  = $("#g18").val();
				
				var total = (g24 * p24) + (g22 * p22 ) + (g21*p21) + (g18*p18);
				
				//"24 : "+(g24 * p24) +" / 22: "+ (g22 * p22 ) +" / 21: "+ (g21*p21) + " / 18 : "+(g18*p18)        alert(total);
				var t = total;
				
				} else {
				t= $("#tot").val();
				
				}
				
				if (t<nis ) {
				
				var mess =  '{message5}';
				} else  {
				/*
				 
				mess = "{valeur zakat}:"+z+" {da}";
				*/
				var z = t * 2.5 / 100 ;
				var mt = new Intl.NumberFormat('dz-DZ',"arab",  { style: 'currency', currency: 'EUR' }).format(z)
	 
				mess = "{valeur zakat}:"+mt+" {da}";
			
				
				
				
				}
				var html = '<br><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				    html +='<span aria-hidden="true">&times;</span></button> '+mess+'</div>';
			document.getElementById('mess').innerHTML = html;
			}
			</script>
		
		<div class="col-sm-6">
		</div>
		</div>
		
		<div id="simul1" class="tab-pane fade  active in">
		
		<h3> </h3>
		<div class="col-md-12 btn-simul">
		<a class="btn " onclick="aff(1)"><img src="images/btn-tayssir1.png" id="btn-tayssir" alt="{facilites}"  /></a> 
		<a class="btn  " onclick="aff(2)"> <img src="images/btn-dar-salam.png" id="btn-dar" alt="{dar salam}"  /> </a>
		<a class="btn  " href="{lg}/page/list-{pg}-0.html"> <img src="images/autre-sim-{lg}.png" alt="{autresim}"  /> </a>
			  
		</div>
		<br /><br />
			<div id="sim1">
			 
			</div>	
		<script src="modules/outils/assets/simul.js" type="text/javascript"></script>
		 <script>
		 /***********/

	$("#btn-tayssir").click(function() {   $("#btn-tayssir").attr("src","images/btn-tayssir1.png");   $("#btn-dar").attr("src","images/btn-dar-salam.png");       });
    $("#btn-dar").click(function() { 	   $("#btn-dar").attr("src","images/btn-dar-salam1.png");  $("#btn-tayssir").attr("src","images/btn-tayssir.png");         });
	var tsu  = false ;
	
	function affSimul1() {
	var html = ''; 
   // var options = new Array( new taux('{financement equipement}',"{t_t1}" ),new taux('{financement vehicule}',"{t_t2}"  ) );
      var options = new Array(new taux('{financement vehicule}',"{t_t2}"  ),  new taux('{financement equipement}',"{t_t1}" ));
	
	html +=affRubTexte('montantBien','{prix auto}','{lg}','',' hasValue ');
	html +=affRubSelect('tauxCharge','{marge}',options,'{lg}');   
	html +=affRubHidden('sanstva' , '0','' ); 
	html +=affRubTexte('salaireEmp','{salaire emprunteur}','{lg}','','hasValue'); 
	            
    html +=affRubTexte('salaireCoEmp','{salaire co-emprunteur}','{lg}','value="0"',"hasValue"); 
    html +=affRubTexte('salaireCumule','{salaire Cumule}','{lg}','readonly="true"');  
	
	html +=affRubHidden('tauxCapacite' , '30','readonly="true"' );   
	html +=affRubHidden('capaciteBrute' , '','readonly="true"' );
	
	html +=affRubHidden('capaciteConsomm' , '0','readonly="true"' );
	html +=affRubHidden('capaciteCautionConsomm' , '0','readonly="true"' );
	
		                                    
    html +=affRubTexte('capaciteNette','{capacite d endettement}','{lg}','readonly="true"' ); 
	
	html +=affRubHidden('tauxMaxFin' , '80','readonly="true"' );
	  
	//html +=affRubTexte('nbEcheance','{Nombre d echeances}','{lg}','id="nbEcheance"  data-slider-min="10" data-slider-max="60"  data-slider-value="10"',' hasValue slider ' ); 
	
	
	//html +='<input id="nbEcheance" data-slider-id="ex1Slider" type="text" data-slider-min="12" data-slider-max="60" data-slider-step="1" data-slider-value="12"/>'
	 
	 
	 
	html +=affSlider('nbEcheance','{Nombre d echeances}','{lg}','hasValue slider','id="nbEcheance"',12,60) 
	  
	
	
	 
	html +=affRubTexte('apportPersonnel','{participation Client}','{lg}','readonly="true"' ); 
	 
	 html +='<span class="help-block" id="apportMin"></span>';
 


   html +='<div class="form-group">';
    	html +=affRubTexte('montantEcheance','{montant echeance}','{lg}','' ,''); 
	
	

	html +=affRubTexte('montantCredit','{montant a financer }','{lg}','readonly="true"' ,' hasValue hasSep'); 

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
   html +='{message8}</div>';
 
	
	$('#sim1').html(html) ;
	
	
	// $('.nb_ech').slider({	formatter: function(value) {alert(55);			return 'Current value: ' + value;	}});
	
	var slider = new Slider('#nbEcheance', {
	formatter: function(value) {  
		return '{Nombre d echeances}: ' + value;
	}
});
	
	}
	
	function affSimul2() {
	var html = ' ';
	
	
 
 
	 
	html += affRubTexte('montantBien','{prix bien}','{lg}','' ,''); 
 
 
     var options = new Array( new taux('{financement dar al salam epargnant}',"{d_t1}" ),new taux('{financement dar al salam epargnant dom }',"{d_t2}"  ) ,new taux('{financement dar al salam non epargnant}',"{d_t3}"  ) );
 
     html +=affRubSelect('tauxCharge','{marge}',options,'{lg}'); 
     html +=affRubHidden('sanstva' , '1','readonly="true"' ); 
   
    html += affRubTexte('salaireEmp','{salaire emprunteur}','{lg}','' ,''); 
	
	html += affRubTexte('salaireCoEmp','{salaire co-emprunteur}','{lg}','' ,''); 
   
  	html += affRubTexte('salaireCumule','{salaire Cumule}','{lg}','readonly="true"' ,' hasValue hasSep'); 
 
 
    html +=affRubHidden('tauxCapacite' , '30','readonly="true"' );   
	html +=affRubHidden('capaciteBrute' , '','readonly="true"' );
    html +=affRubHidden('capaciteConsomm' , '0','readonly="true"' );               
    html +=affRubHidden('capaciteCautionConsomm' , '0','readonly="true"' );    
	
	 
	html += affRubTexte('capaciteNette','{capacite d endettement}','{lg}','readonly="true"' ,' hasValue hasSep');    
 
   	html +=affRubHidden('tauxMaxFin' , '80','readonly="true"' ); 
    
	//html += affRubTexte('nbEcheance','{Nombre d echeances}','{lg}','data-slider-min="60" data-slider-max="300" data-slider-step="1" data-slider-value="60" data-slider-selection="after" data-slider-tooltip="show"' ,' hasValue slider nb_ech'); 
	
	html +=affSlider('nbEcheance','{Nombre d echeances}','{lg}','hasValue slider','id="nbEcheance"',60,300) 
	
	
	
	html += affRubTexte('apportPersonnel','{participation Client}','{lg}','readonly="true"' ,''); 
	
 
	
   
            
     
	
 
	
	html +='<div class="form-group">';
	
    html += affRubTexte('montantEcheance','{montant echeance}','{lg}','readonly="true"' ,''); 
	
    html += affRubTexte('montantCredit','{montant a financer }','{lg}','readonly="true"' ,''); 
                   
     
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
	
	$('#sim1').html(html) ;
	  
	
	var slider = new Slider('#nbEcheance', {
	formatter: function(value) {  
		return '{Nombre d echeances} : ' + value;
	}
});
	
	}
		
		  

 			function aff(t) {
			 
			if (t!=1) {
			tsu=true;
			 affSimul2();  } 
			else { affSimul1(); tsu=false;  }
			 
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

		 
		 </script>
		 
		 
		
		</div>
		<div id="meteo_tab" class="tab-pane fade">
		<h3 id="d_meteo" class="p_gros"> </h3>
		<div class="row">
    	<div id="pan_meteo" class="ligne col-sm-9 "></div>
		
		
		<div class="col-sm-3">
		{villes1}
		 
		</div>
		</div>
		</div>
		<div id="convert" class="tab-pane fade">
		<h3></h3>
		<div class="col-sm-6">
    	<form id="form_convert">
		<div class="input-group">
		{du dinar}  <input onchange="aff()" name="type" type="radio" value="1"> <br>
{vers dinar}<input onchange="aff()" name="type" type="radio" value="2">  

		</div>
			<div class="input-group" dir="rtl">
  			<input type="text" class="form-control inp150" placeholder="{montant transfer} " id="mt_tot"><br />
			 
			 
			
			 {monnaies}
			 
			</div>
			 <button class="btn btn-default" type="button" onclick="convert()">  {convert}</button>
			<div id="mt_convert"></div>
			<script>
			function aff2() { 
			var article = $('input[name=type]:checked', '#form_convert').val()
			
			//alert(article)
			
			}
			function convert() {
			var article = document.getElementById('from');
				var selected = article.options[article.selectedIndex];
				var a  = selected.dataset.achat;
				var v  = selected.dataset.vente;
				var c  = selected.dataset.mon;
				var mt = document.getElementById('mt_tot').value; 
				var de = $('input[name=type]:checked', '#form_convert').val()
				var tr = 0 ;
				if (de!=1) { tr = mt * a; mon = "{da}" } else {  tr = mt/v;  mon = c}
			
			
				
			var html = '<br><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				    html +='<span aria-hidden="true">&times;</span></button>{message6}<br>';
					html +=mt+' = '+parseFloat(tr).toFixed(2)+' '+mon+'</div>';
					
			//		parseFloat(document.getElementById(amtid4).innerHTML);
			document.getElementById('mt_convert').innerHTML = html;
			
			}
			
			
			</script>
			
			</form>
			
			</div><div class="col-sm-6"></div>
		</div>
		</div>
	</div>
	<script>
$(document).ready(function(){
    $(".nav-pills a").click(function(){
        $(this).tab('show');
    });
    
   $("#tools .slider-horizontal [name!='sliderNb'] ").css("display","none");  
    affSimul1(); 
});

affSalat(36.4700400, 2.8277000);

	function affSalat(lg,lt) {

	var date = new Date(); // today
	var times = prayTimes.getTimes(date, [lg,lt], +1);
	var list = [ 'Isha', 'Maghrib', 'Asr', 'Dhuhr','Fajr'];  
	var n  = ['{isha}','{maghreb}',  '{asr}', '{dhohr}', '{fedjr}'];
	 
	var html = '<ul id="timetable" class="kufi_1">';
 
	var h2   = '  '+ date.toLocaleDateString()+ ' ';
	for(var i in list)	{
		html += '<li><label class="mid">'+ n[i] + '</label>:<span class="hugh">'+ times[list[i].toLowerCase()]+ '</span></li> ';
	}
	html += '</ul>';
	document.getElementById('table').innerHTML = html;
	document.getElementById('youm').innerHTML = h2;
	
	
	
	
	}
	
	function affPray() { 
 
	var article = document.getElementById('medina');
	var selected = article.options[article.selectedIndex];
	var lg = selected.dataset.lg;
	var lt = selected.dataset.lt;
	 
	affSalat(lg, lt) ;
	
	}

	function affMeteo() { 
 
	var article = document.getElementById('medina-meteo');
	var selected = article.options[article.selectedIndex];
	var w = selected.dataset.w;
	var lt = selected.dataset.lt;
	 
	//alert(w);
	 
	
	$.ajax({ 	
	url:'https://query.yahooapis.com/v1/public/yql?q=select * from weather.forecast where woeid in ( '+w+' ) And u="c"&format=json&callback=callbackFunction' 
	});/**/
	
	}	

 
  var callbackFunction = function(data) {
  
	var image    = data.query.results.channel ;
    var wind     = data.query.results.channel.wind ;
	var atmos    = data.query.results.channel.atmosphere ;
    var forecast = data.query.results.channel.item.forecast;
    var results = data.query.results.channel.item.condition;
    var html ='';	
	var date = new Date(); // today
	var h2   = '  '+ date.toLocaleDateString()+ ' ';
		html 	+=  ' <div class="row"><div class="col-sm-6"><img src="images/meteo1/'+results.text.toLowerCase().replace(' ','_')+'.png" width="128" height="128"></div> ' ;
	html 	+=  '<div class="col-sm-6"><span  class="tit">|'+results.text+'|</span>  ' ;
	html 	+=  '-<span  class="tit">'+results.temp+'&deg;</span> ' ;
	html 	+=  ' <div>{humidite} : '+atmos.humidity+'%</div>' ;
	html 	+=  '<div>{vent} : '+wind.speed+' km/h</div>' ;
	html 	+=  '<div>Min :'+ forecast[0].low+'&deg; | Max : '+forecast[0].high+'&deg;</div>' ;
	html 	+=  ' </div></div>' ;
	
	//'  <li> '+temp +'  Basse : '++'  Haute : '++'</div>';

	document.getElementById('pan_meteo').innerHTML = html;
	document.getElementById('d_meteo').innerHTML = h2;
  };
  
  if(window.matchMedia("(max-width:640px)").matches)  {
  $('#priere ul').html($('#priere ul').find('li').get().reverse());
 }
 
</script>
<script src="https://query.yahooapis.com/v1/public/yql?q=select * from weather.forecast where woeid in ( 1253475 ) And u='c'&format=json&callback=callbackFunction"></script>
		



 
	
</section>
