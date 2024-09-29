<?php 

class modelVehicules {
	public $db  ; 
	public $lg  ;  
	public function __construct($c)
	{

		$this->cx  = $c->cx->cx;
		$this->db  = $this->cx->db;
		$this->lg	= $c->lg;


	 if ( isset($_GET['id']) )   { $this->id = (int)  $_GET['id']; }  
	 if ( isset($_GET['num']) )   { $this->num = (int) $_GET['num']; }
	}
	
	public function getList($search) {
		
		
		
	$this->db->resetSelect();
	$this->db->addSelected('v.*', ''); 
	$this->db->addSelected('ma.libelle', 'lamarque'); 
	$this->db->addSelected('mo.libelle', 'lemodel'); 
	
	$this->db->addWhere('ma.id = v.marque'); 
	$this->db->addWhere('mo.id = v.model'); 
	$this->db->addWhere('v.publier = 1 '); 
 						
	$this->db->addFrom('is_vehicule v');
	$this->db->addFrom('is_marque ma');
	$this->db->addFrom('is_model mo');
	
	$this->db->addOrderBy('quantite DESC');
	
	
		
		if (!empty($search)) {
		$s = "'%".$search."%'"; 
		$this->db->addWhere(  "CONCAT(ma.libelle,' ',mo.libelle,' ',v.motorisation,v.edition)    Like ".$s."");
		 }
		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'.  $this->db->q;  return '';  }
        else {  $rows =  $this->db->getAllRows();  }
		
	  return $rows;
	 
	 }
	 
	 
   function getSimulation() {
   $this->db->resetSelect();
    $this->db->addSelected('v.motorisation', ''); 
	$this->db->addSelected('v.edition', ''); 
	$this->db->addSelected('v.photo', ''); 
	$this->db->addSelected('v.prix', ''); 
	$this->db->addSelected('ma.libelle', 'lamarque'); 
	$this->db->addSelected('mo.libelle', 'lemodel'); 
	
	$this->db->addWhere('ma.id = v.marque'); 
	$this->db->addWhere('mo.id = v.model'); 
 						
	$this->db->addFrom('is_vehicule v');
	$this->db->addFrom('is_marque ma');
	$this->db->addFrom('is_model mo');
   
   $this->db->addWhere('v.id = :id'); 
   $this->db->addParamToBind('id',  $this->num );
			
			
    if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'.  $this->db->q;  return '';  }
        else {  $rows =   $this->db->getNextRow();   }
		
	  return $rows;
        
   }

   function getConventions() {
   
   
   $this->db->resetSelect();
   $this->db->addSelected('*', ''); 
   
   $this->db->addWhere('publier = 1 '); 
   
   $this->db->addFrom('is_convention');
   
   
   $this->db->addOrderBy('ordre');
   
    if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'.  $this->db->q;  return '';  }
        else {  $rows =  $this->db->getAllRows();  }
   
	return $rows;
   }
   
   
   function getOutilsParams() {
   
	   $this->db->resetSelect();
	   $this->db->addSelected('param', ''); 
	   $this->db->addFrom('is_modules ');
	   $this->db->addWhere( "libelle ='outils'  "); 
	   
	   
	  if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'.  $this->db->q;  return '';  }
        else {  $rows =   $this->db->getNextRow();   }
		
	  return $rows['param'];
        
    
   
   
   }
   
   
   /****************************/

	public function listVehicule() {
	
     
	  
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

	 
	  
		$this->db->resetSelect();
		$this->db->addSelected('*', ''); 

		$this->db->addFrom('is_marque');





		if (!$this->db->select()){ echo 'ERREUR: Marque  '.$this->db->getErrMessage().'<br><br>'; }
        else {   
 				 
	 
		$result = $this->db->getAllRows();
	    return $result ;  }



	}


/*****************************/
//Fin classe
}
?>
