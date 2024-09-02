<section id="tools">
	  <div class="container">
	  	<ul class="nav nav-pills nav-justified">
  			<li role="presentation" class="active"><a href="{ceURL}#priere"> {horraire priere} <span class="fa fa-moon-o"></span></a></li>
  			<li role="presentation" class=""><a href="{ceURL}#zakat">{zakat} <span class="fa fa-envira"></span></a></li>
  			<li role="presentation" class=""><a href="{ceURL}#simul1">{simul} <i class="fa fa-calculator" aria-hidden="true"></i></a></li>
			<li role="presentation" class=""><a href="{ceURL}#meteo_tab">{meteo} <i class="fa fa-sun-o" aria-hidden="true"></i></a></li>
			<li role="presentation" class=""><a href="{ceURL}#convert">{convertion} <i class="fa fa-money" aria-hidden="true"></i></a></li>
		</ul>
		<div class="tab-content">
		<div id="priere" class="tab-pane fade priere active in">
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
  			<div class="btn-group bootstrap-select input-group-btn">
			
			<button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" data-id="zakat_type" title="{comptant}">
			<span class="filter-option pull-left">{comptant} </span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
			
			<div class="dropdown-menu open" role="combobox"><ul class="dropdown-menu inner" role="listbox" aria-expanded="false"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">{comptant}</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
			
			<li data-original-index="1"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">{or}</span>
			<span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul>
			</div>
			<select onchange="affData()" name="type_zakat" id="zakat_type" class="selectpicker" tabindex="-98">
			  <option value="1">{comptant}</option>
			  <option value="2">{or} </option>
			   
			</select></div>
			
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
			
			var p24 = 6800;
			var p22 = 6400;
			var p21 = 6000;
			var p18 = 5000;
			var nis = 500000;
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
				
				var z = t * 2.5 / 100 ;
				mess = "{valeur zakat}:"+z;
				}
				var html = '<br><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				    html +='<span aria-hidden="true">&times;</span></button> '+mess+'</div>';
			document.getElementById('mess').innerHTML = html;
			}
			</script>
		
		<div class="col-sm-6">
		</div>
		</div>
		<div id="simul1" class="tab-pane fade">
		<h3> </h3>
		<div class="col-md-6">
		<button class="btn btn-primary" onclick="aff(1)">{facilites}</button>
		 
		 
		<button class="btn btn-primary" onclick="aff(2)">{dar salam} </button>
		</div>
		<br><br>
			<div id="sim1"><label for="Prix du bien" class="col-md-5 control-label">Prix du bien</label><div class="col-md-6"><input class="form-control hasValue hasSep" id="montantBien" name="montantBien" type="text"></div><label for="Marge" class="col-md-5 control-label">Marge(%)</label> <div class="col-md-6"><select class="form-control hasValue" id="tauxCharge" name="tauxCharge"><option value="11">Financement Equipement </option><option value="9.5">Financement Véhicules </option>  </select></div> <!-- update --><label for="Salaire Emprunteur" class="col-md-5 control-label">Salaire Emprunteur</label><div class="col-md-6"><input class="form-control hasValue hasSep" id="salaireEmp" name="salaireEmp" type="text"></div><label for="Salaire Co-Emprunteur" class="col-md-5 control-label">Salaire Co-Emprunteur</label><div class="col-md-6"><input class="form-control hasValue hasSep" id="salaireCoEmp" name="salaireCoEmp" type="text" value="0"></div><label for="Salaire Cumule" class="col-md-5 control-label">Salaire Cumulé</label><div class="col-md-6"><input class="form-control hasValue hasSep" readonly="true" id="salaireCumule" name="salaireCumule" type="text"></div><div class="col-md-6">
			<input class="form-control hasValue" id="tauxCapacite" name="tauxCapacite" value="30" type="hidden"></div><div class="col-md-6"> <input class="form-control hasValue hasSep" readonly="true" id="capaciteBrute" name="capaciteBrute" type="hidden"></div><div class="col-md-6"><input class="form-control hasValue hasSep" id="capaciteConsomm" name="capaciteConsomm" type="hidden" value="0"></div><div class="col-md-6"><input class="form-control hasValue hasSep" id="capaciteCautionConsomm" name="capaciteCautionConsomm" type="hidden" value="0"></div><label for="Cap Endett Nette" class="col-md-5 control-label">Capacité d'endettement Nette</label><div class="col-md-6"><input class="form-control hasValue hasSep" readonly="true" id="capaciteNette" name="capaciteNette" type="text"></div>   <input class="form-control hasValue" id="tauxMaxFin" name="tauxMaxFin" value="80" type="hidden">  <label for="Nombre d'échéances (Mois)" class="col-md-5 control-label">Nombre d'échéances (Mois)</label><div class="col-md-6"> <div class="slider slider-horizontal ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="sliderNb"><div class="slider-track"><div class="slider-track-low" style="left: 0px; width: 0%;"></div><div class="slider-selection" style="left: 0%; width: 100%;"></div><div class="slider-track-high" style="right: 0px; width: 0%;"></div></div><div class="tooltip tooltip-main top" role="presentation" style="left: 0%; margin-left: 0px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">Nombre d'echeance : 24</div></div><div class="tooltip tooltip-min top" role="presentation"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><div class="tooltip tooltip-max top" role="presentation"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><div class="slider-handle min-slider-handle round" role="slider" aria-valuemin="24" aria-valuemax="60" aria-valuenow="24" tabindex="0" style="left: 0%;"></div><div class="slider-handle max-slider-handle round hide" role="slider" aria-valuemin="24" aria-valuemax="60" aria-valuenow="60" tabindex="0" style="left: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span></div><input class="form-control hasValue slider nb_ech ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-slider-id="sliderNb" id="nbEcheance" name="nbEcheance" type="text" data-slider-min="24" data-slider-max="60" data-slider-step="1" data-slider-value="24" data-slider-selection="after" data-slider-tooltip="show" data-value="24" value="24" style="display: none;"></div>  <label for="Hamich Dham?ne Jeddiya" class="col-md-5 control-label">Participation Client /Hamich El Djadiah</label><div class="col-md-6"><input class="form-control hasUpdate" id="apportPersonnel" name="apportPersonnel" type="text"><span class="help-block" id="apportMin"></span></div>  <div class="form-group"><label for="Montant échéance (TTC)" class="col-md-5 control-label">Montant échéance (TTC)</label> <div class="col-md-6"><input class="form-control" readonly="true" id="montantEcheance" name="montantEcheance" type="text"></div><label for="Montant à financer" class="col-md-5 control-label">Montant à financer</label><div class="col-md-6"><input class="form-control hasValue hasSep" readonly="true" id="montantCredit" name="montantCredit" type="text"><span class="help-block" id="pourcentFin"></span></div>   </div> <div class="form-group"><div class="col-md-10"><input class="form-control" readonly="true" id="montantRembour" name="montantRembour" type="hidden"></div></div> <div class="form-group"><div class="col-md-10"><input class="form-control" readonly="true" id="montantMarget" name="montantMarget" type="hidden"></div></div><div class="form-group"> <div class="col-md-10"><input class="form-control" readonly="true" id="montantTva" name="montantTva" type="hidden"></div></div>  <div class="col-md-10"> <b>NB :</b>cette simulation vous est donnée à titre indicatif , et n’engage nullement la banque.</div></div>	
				
		 
		 <script src="{URL}/js/simul.js" type="text/javascript"></script>
		 <script>
		 
		 affSimul1();
		  

 			function aff(t) {
			 
			if (t!=1) {
			 affSimul2();  } 
			else { affSimul1();  }
			 
			}
		 
		 </script>
		 
		 
		
		</div>
		<div id="meteo_tab" class="tab-pane fade">
		<h3 id="d_meteo" class="p_gros"> </h3>
    	<div id="pan_meteo" class="ligne"></div>
		
		</div>
		<div id="convert" class="tab-pane fade">
		<h3></h3>
		<div class="col-sm-6">
    	<form id="form_convert">
		<div class="input-group">
		{du dinar}  <input onchange="aff()" name="type" type="radio" value="1"> 
{vers dinar}<input onchange="aff()" name="type" type="radio" value="2">  

		</div>
			<div class="input-group">
  			<input type="text" class="form-control" placeholder="{montant transfer} " id="mt_tot">
			 
			<div class="btn-group bootstrap-select input-group-btn"><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" data-id="from" title="USD"><span class="filter-option pull-left">USD</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" role="combobox"><ul class="dropdown-menu inner" role="listbox" aria-expanded="false"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">USD</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Euro</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Gbp</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="3"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Jpy</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="4"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Chf</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div>
			
			
			<select onchange="convert()" name="from" id="from" class="selectpicker" tabindex="-98">
				  <option data-achat="112.04" data-vente="118.88" data-mon="$">USD</option>
				   <option data-achat="132.36" data-vente="140.48" data-mon="Eur">Euro</option>
				   <option data-achat="149.17" data-vente="158.30" data-mon="Gbp">Gbp</option>
				   <option data-achat="100.04" data-vente="106.16" data-mon="Jpy">Jpy</option>
				   <option data-achat="11483" data-vente="12189.10" data-mon="chf">Chf</option>
			</select></div>
			</div>
			 <button class="btn btn-default" type="button" onclick="convert()">  convert</button>
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
				if (de!=1) { tr = mt * a; mon = "Da" } else {  tr = mt/v;  mon = c}
			
			
				
			var html = '<br><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				    html +='<span aria-hidden="true">&times;</span></button>{message6}<br>';
					html +=mt+' = '+tr+' '+mon+'</div>';
			document.getElementById('mt_convert').innerHTML = html;
			
			}
			
			
			</script>
			
			</form>
			
			</div><div class="col-sm-6"></div>
		</div>
		</div>
	</div>
	??<script>
$(document).ready(function(){
    $(".nav-pills a").click(function(){
        $(this).tab('show');
    });
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
	alert(1);
	var article = document.getElementById('medina');
	var selected = article.options[article.selectedIndex];
	var lg = selected.dataset.lg;
	var lt = selected.dataset.lt;
	 
	affSalat(lg, lt) ;
	
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
	html 	+=  ' <table width="400"><tr><td><img src="images/meteo1/'+results.text.toLowerCase().replace(' ','_')+'.png" width="128" height="128"></td> ' ;
	html 	+=  '<td align="left"><span  class="tit">|'+results.text+'|</span>  ' ;
	html 	+=  '-<span  class="tit">'+results.temp+'&deg;</span> ' ;
	html 	+=  ' <div>{humidite} : '+atmos.humidity+'%</div>' ;
	html 	+=  '<div>{vent} : '+wind.speed+' km/h</div>' ;
	html 	+=  '<div>Min :'+ forecast[0].low+'&deg; | Max : '+forecast[0].high+'&deg;</div>' ;
	html 	+=  '</td></tr></table>' ;
	//'  <li> '+temp +'  Basse : '++'  Haute : '++'</div>';

	document.getElementById('pan_meteo').innerHTML = html;
	document.getElementById('d_meteo').innerHTML = h2;
  };
  
</script>
<script src="https://query.yahooapis.com/v1/public/yql?q=select * from weather.forecast where woeid in ( 1253475 ) And u='c'&format=json&callback=callbackFunction"></script>
		



 
	
	 </section>
