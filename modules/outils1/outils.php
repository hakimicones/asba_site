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
	
	public function listVille() {
	 $li = '';
	  $db =  $this->cx->db ;
	  
	   $db->resetSelect();
	   $db->addSelected('*', '');
	   $db->addFrom('is_wilayas');
	   
	   
	   
  if (!$db->select()){ echo 'ERREUR: Mi-Slider  '.$db->getErrMessage().'<br><br>'; }
        else {   
 // echo $db->q;
	 
		$result = $db->getAllRows();
	   return $result ;  
	}
	}
	
	 
	
	public function getVilles($f=true) {
	if ($f) {
	
	$funct = "affPray(this)";
	} else {
	$funct = "affMeteo(this)";
	
	}
	
	$se   = '<select onchange="'.$funct.'" name="ville" id="medina" class="selectpicker" data-live-search="true" > ';	
	
	
	$vil = $this->listVille();
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	 $check = ($el['libelle_Fr']=='  Alger  ')?'selected':'';
	$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select>';
			 
			return $se ;
	
	 
	}
	
	public function affiche() { 
	 	$url = 'modules/outils/tpl/tpl.php';
		$data = file_get_contents($url) ;
		$tag[]  =  '{villes}';
		$ext[]  =  $this->getVilles() ; 
		
		 
		$tag[]  =  '{p24}';
		$ext[]  =  $this->params->p24 ;
		 
		$tag[]  =  '{p22}';
		$ext[]  =  $this->params->p22 ;
		
		$tag[]  =  '{p21}';
		$ext[]  =  $this->params->p21 ;
		
		$tag[]  =  '{p18}';
		$ext[]  =  $this->params->p18 ;
		
 
		
		$tag[]  =  '{nis}';
		$ext[]  =  $this->params->nis ;
		
		$html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	}
}


?>
 

