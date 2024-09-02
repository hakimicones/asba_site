<?php 
class simulateur {
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
	
	
	public function listVehicule() {
	
    $this->db =  $this->cx->db ;
	  
	$this->db->resetSelect();
	$this->db->addSelected('v.*', ''); 
	$this->db->addSelected('ma.libelle', 'lamarque'); 
	$this->db->addSelected('mo.libelle', 'lemodel'); 
	
	$this->db->addWhere('ma.id = v.marque'); 
	$this->db->addWhere('mo.id = v.model'); 
 						
	$this->db->addFrom('is_vehicule v');
	$this->db->addFrom('is_marque ma');
	$this->db->addFrom('is_model mo');
	   
	   
  		if (!$this->db->select()){ echo 'ERREUR: Mi-Slider  '.$this->db->getErrMessage().'<br><br>'; }
        else {   
 				//echo $db->q;
	 
		$result = $this->db->getAllRows();
	    return $result ;  }
	
	}

	public function listMarque() {

		$this->db =  $this->cx->db ;
	  
		$this->db->resetSelect();
		$this->db->addSelected('*', ''); 

		$this->db->addFrom('is_marque');





		if (!$this->db->select()){ echo 'ERREUR: Marque  '.$this->db->getErrMessage().'<br><br>'; }
        else {   
 				 
	 
		$result = $this->db->getAllRows();
	    return $result ;  }



	}

	private function affListeMarque() {
	
	
	$se   = '<!-- ajout --><select   name="Marques" id="Marques" onchange="affModel()" class="form-control"  data-live-search="true" > ';	
	 
	
	$vil = $this->listMarque();
	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';    
	$se .=  '  <option value='.$el['id'].'   >'.$el['libelle'].'</option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select><!-- ajout -->';
			 
			return $se ;
	
	
	
	}

	/****************************************************/
	private function affListeVehicule() {
	
	 
	$se   = '<!-- ajout --><select   name="montantBien" id="montantBien"   class="selectpicker " data-live-search="true" > ';	
	 
	
	$vil = $this->listVehicule();
	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';    
	$se .=  '  <option value='.$el['prix'].'   >'.$el['lamarque'].' '.$el['lemodel'].' '.$el['motorisation'].'  '.$el['edition'].'</option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select><!-- ajout -->';
			 
			return $se ;
	
	
	
	}
	
	 
	
	
	 
	 
	
	 
	/*************************************/
	
	public function affiche() { 
	 	$url = 'modules/simulateur/tpl/tpl2.php';
		$data = file_get_contents($url) ; 
		
		
		 $tag[]  =  '{t_t1}';
		$ext[]  =  $this->params->t_t1 ;
		
		$tag[]  =  '{t_t2}';
		$ext[]  =  $this->params->t_t2 ;
		
		$tag[]  =  '{tva}';
		$ext[]  =  $this->params->tva ;		
	 
		
		$tag[]  =  '{d_t1}';
		$ext[]  =  $this->params->d_t1 ;
		
		$tag[]  =  '{d_t2}';
		$ext[]  =  $this->params->d_t2 ;
		
		$tag[]  =  '{d_t3}';
		$ext[]  =  $this->params->d_t3 ;
		
		$pg = "pg_".$this->lg;
		$tag[]  =  '{pg}'; 
		$ext[]  =  $this->params->$pg ;	
		
					 
		$tag[]  =  '{vehicule}';
		$ext[]  =  $this->affListeVehicule();

		$tag[]  =  '{marques}';
		$ext[]  =  $this->affListeMarque();

		
		$html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	}
}


?>
 

