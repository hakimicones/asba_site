<?php 

class modelArticle {
	public $db  ; 
	public $lg  ;  
	public function __construct($db,$lg)
	{

	 $this->db  = $db;
	 $this->lg	= $lg;
	}
	
	public function getData($search) {
		
		
		
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		
		$this->db->addFrom('is_contenu'); 
		$this->db->addWhere(' `publier` = 1');
		$this->db->addOrderBy('ordre'); 
		
		 
		 if (!$this->db->select()){  
			
			$this->cx->getMessageErr('ERREUR->getData: '.$db->getErrMessage().'  '.$db->q);
			return ''; 
		
		}
        else {  $rows =  $this->db->getNextRow();}
		
	  return $rows;
	 
	 }
	 
	 




//Fin classe
}
?>
