<?php 
class y_meteo {
	public  $cx ;
	private $obj ;
	public $li ;
	public $lg;
	public $script ;
	
public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;	 
	}
	
	public function affiche() { 
	$div 	 ='<a href="javascript:;" class="meteo_btn" data-toggle="tooltip" title="" 
	data-original-title="Meteo"> <i class="fa fa-thermometer-empty"  ></i> </a>';
	$div 	.= '<div id="menumeteo" class="ligne"> </div> ';
	/*$div	.= '<script type="text/javascript" src="modules/y-meteo/js/script.js"></script>'; */
	
	$div	.='<script>var callbackFunction = function(data) {
  
	var image    = data.query.results.channel ;
    var wind     = data.query.results.channel.wind ;
	var atmos    = data.query.results.channel.atmosphere ;
    var forecast = data.query.results.channel.item.forecast;
    var results = data.query.results.channel.item.condition;
    var html =\'<a href="javascript:;" class="fermemeteo" style="display: none;"><i class="fa fa-arrow-right" ></i></a>\';	
	html 	+=  \'<ul> <li class="ret30"><img src="images/meteo/\'+results.text.toLowerCase().replace(\' \',\'_\')+\'.png" width="32" height="32"></li>\' ;
	html 	+=  \'<li  class="tit">\'+results.text+\' </li>\' ;
	html 	+=  \'<li  class="tit">\'+results.temp+\'&deg;</li>\' ;
	html 	+=  \'<li>Humidit&eacute; : \'+atmos.humidity+\'%</li>\' ;
	html 	+=  \'<li>Vent : \'+wind.speed+\' km/h</li>\' ;
	html 	+=  \'<li>Min :\'+ forecast[0].low+\'&deg; | Max : \'+forecast[0].high+\'&deg;</li>\' ;
	html 	+=  \' </ul>\' ;
	 
	 
	document.getElementById(\'menumeteo\').innerHTML = html;
  }; </script>';
	
	
	$div    .= '<script src="https://query.yahooapis.com/v1/public/yql?q=select * from weather.forecast where woeid in ( 1253475 ) And u=\'c\'&format=json&callback=callbackFunction"></script>';
	return 	$div ;		
	
	}
}


?>