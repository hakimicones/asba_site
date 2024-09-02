<?php 

class modelFatawa {
	public $db  ; 
	public $lg  ;  
	public function __construct($db,$lg)
	{

	 $this->db  = $db;
	 $this->lg	= $lg;
	 $this->num   = (isset($_GET['num']))? (int) $_GET['num']:0;
	 $this->c  = (isset($_POST['cat']))? $_POST['cat']:0;
	   
	}
	
	public function getData($search) { 
	if (!empty($search) or ($this->c!=0)) {
		
		$this->db->resetSelect();
		$this->db->addSelected('f.*', '');
		$this->db->addSelected('c.title', 'lib_cat'); 						
		$this->db->addFrom('is_fatawa f ');
		$this->db->addFrom('is_cat_fatwa c');
	
		$this->db->addWhere(' f.categorie = c.id'); 	 		
		$this->db->addWhere('  f.publier  = 1');
		$this->db->addOrderBy('f.ordre'); 
		
		if ($this->c!=0) {
		$this->db->addWhere(  'f.categorie = '.$this->c);
		
		}
		
		if (!empty($search)) {
		$s = "'%".$search."%'"; 
		$this->db->addWhere(  '(f.title  Like '.$s.'  OR  `full_text`  Like '.$s.')');
		 }
		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {       $rows =  $this->db->getAllRows();}
		
	  return $rows; } else {return 0;}
	 
	 }
	 public function getCat() { 
		
		$this->db->resetSelect();
		$this->db->addSelected('*', '');

		$this->db->addFrom('is_cat_fatwa ');
	
		 		
		$this->db->addWhere('  publier  = 1');
		$this->db->addOrderBy('ordre'); 
		
		
		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {      $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }	 
	 
//Fin classe
}
?>
