<?php 

class modelAgences {
	public $db  ; 
	public $lg  ;  
	public function __construct($db,$lg)
	{

	 $this->db  = $db;
	 $this->lg	= $lg;
	}
	
	public function getData($search) {
		
		
		$region = (isset($_POST['region'])) ? $_POST['region'] : 1 ;
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		
		$this->db->addFrom('is_agences'); 
		 $this->db->addWhere(' `publier` = 1');
		 $this->db->addWhere(' `region` =  '. (int) $region);
		$this->db->addOrderBy('ordre'); 
		
		if (!empty($search)) {
		$s = "'%".$search."%'"; 
		$this->db->addWhere(  'libelle_'.$this->lg.' Like '.$s.'  OR  `directeur`  Like '.$s.' OR  `adresse_'.$this->lg .'`   Like '.$s.'');
		 }
		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }
	 
	 




//Fin classe
}
?>
