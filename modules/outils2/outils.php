<?php 
class outils {
	private $cx ;
	private $obj ;
	private $lg ;
	public $li ;
	public $mess = 2 ;
	public $params;
	public $script ;

public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->params  = $this->obj->param;
	}
	
	public function model() {
	 
	  
	 
	 
	  
	
	}
	
	
	public function getVilles() {
	
	$ville =  '<div class="btn-group bootstrap-select"><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" data-id="medina" title="Alger"><span class="filter-option pull-left">Alger</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" role="combobox"><div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div><ul class="dropdown-menu inner" role="listbox" aria-expanded="false"><li data-original-index="0" class="selected"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">Alger</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Blida</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Oran</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="3"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Constantine</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="4"><a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Anaba</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div><select onchange="affPray(this)" name="ville" id="medina" class="selectpicker" data-live-search="true" tabindex="-98">
			  <option data-lg="36.7525000" data-lt="3.0419700">Alger</option>
			  <option data-lg="36.4700400" data-lt="2.8277000">Blida</option>
			  <option data-lg="35.6911100" data-lt="-0.6416700">Oran</option>
			  <option data-lg="36.3650000" data-lt="6.6147200">Constantine</option>
			  <option data-lg="36.9000000" data-lt="7.7666700">Anaba</option>
			</select></div>';
			
			return $ville;
	
	 
	}
	
	public function affiche() { 
	 	$url = 'modules/outils/tpl/tpl.php';
		$data = file_get_contents($url) ;
		$tag[]  =  '{villes}';
		$ext[]  =  $this->getVilles() ; 
		
		 
		$html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	}
}


?>
 

