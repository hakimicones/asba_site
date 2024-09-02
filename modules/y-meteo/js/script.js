// JavaScript Document
var callbackFunction = function(data) {
  
	var image    = data.query.results.channel ;
    var wind     = data.query.results.channel.wind ;
	var atmos    = data.query.results.channel.atmosphere ;
    var forecast = data.query.results.channel.item.forecast;
    var results = data.query.results.channel.item.condition;
    var html ='<a href="javascript:;" class="fermemeteo" style="display: none;"><i class="fa fa-arrow-right" ></i></a>';	
	html 	+=  '<ul> <li class="ret30"><img src="images/meteo/'+results.text.toLowerCase().replace(' ','_')+'.png" width="32" height="32"></li>' ;
	html 	+=  '<li  class="tit">'+results.text+' </li>' ;
	html 	+=  '<li  class="tit">'+results.temp+'&deg;</li>' ;
	html 	+=  '<li>Humidité : '+atmos.humidity+'%</li>' ;
	html 	+=  '<li>Vent : '+wind.speed+' km/h</li>' ;
	html 	+=  '<li>Min :'+ forecast[0].low+'&deg; | Max : '+forecast[0].high+'&deg;</li>' ;
	html 	+=  ' </ul>' ;
	//'  <li> '+temp +'  Basse : '++'  Haute : '++'</div>';
	console.log(wind )
	document.getElementById('menumeteo').innerHTML = html;
  };