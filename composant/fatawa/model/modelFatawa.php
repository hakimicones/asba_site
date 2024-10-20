<?php 

class modelFatawa {
	public $db  ; 
	public $lg  ;  
	public function __construct($c)
	{

		$this->db  = $c->cx->db;
		$this->lg	= $c->lg;
		
		$this->cx  = $c->cx->cx;

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
		$this->db->addWhere(  'f.categorie = :categorie ' );
		$this->db->addParamToBind('categorie', $this->c );
		}
		
		if (!empty($search)) {
		$s = "'%".$search."%'"; 

		$this->db->addWhere(  '(f.title  Like :rech  OR  `full_text`  Like :rech)');
		$this->db->addParamToBind('rech', $s );


		 }
		 if (!$this->db->select()){ 
			
			$this->cx->getMessageErr('Fatawa->getData: '.$this->db->getErrMessage().'  '.$this->db->q);
			return ''; 	
		
		
		}
        else {       $rows =  $this->db->getAllRows();}
		
	  return $rows; } else {return 0;}
	 
	 }
	 public function getCat() { 
		
		$this->db->resetSelect();
		$this->db->addSelected('*', '');

		$this->db->addFrom('is_cat_fatwa ');
	
		 		
		$this->db->addWhere('  publier  = 1');
		$this->db->addOrderBy('ordre'); 
		
		
		 if (!$this->db->select()){  
			
			$this->cx->getMessageErr('Fatawa->getCat: '.$this->db->getErrMessage().'  '.$this->db->q);
			return ''; 	
		
		
		}
        else {      $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }	 
	 
//Fin classe
}
?>
