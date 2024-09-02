<?php 

class modelBlog {
	public $db  ; 
	public $lg  ;  
	public function __construct($db,$lg)
	{

	 $this->db  = $db;
	 $this->lg	= $lg;
	 $this->num   = (isset($_GET['num']))? (int) $_GET['num']:0;
	}
	
	public function getData($search) { 
		
		$this->db->resetSelect();
		$this->db->addSelected('co.* ','' );
		$this->db->addSelected('ca.type ','' );
		$this->db->addSelected('ca.id ','id_blog' );
		$this->db->addSelected('ca.sep ','' );
		$this->db->addSelected('ca.libelle ','lib_cat' );
		
		$this->db->addFrom('is_categorie as ca'); 
		$this->db->addFrom('is_contenu as co');	 
		
		$this->db->addWhere('co.id_item = ca.id');	
		$this->db->addWhere('co.id_item = '.$this->num);
		 $this->db->addWhere('id_appli   = 11');	
		 		
		$this->db->addWhere('  co.publier  = 1');
		$this->db->addOrderBy('ordre'); 
		
		if (!empty($search)) {
		$s = "'%".$search."%'"; 
		$this->db->addWhere(  '(co.libelle  Like '.$s.'  OR  `intro_text`  Like '.$s.')');
		 }
		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {      $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }
	 	 
	 
//Fin classe
}
?>
