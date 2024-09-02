<?php 

class modelProduits {
	public $db  ; 
	public $lg  ; 
	public $id ; 
	public function __construct($db,$obj)
	{

	 $this->db  = $db;
	 $this->lg	= $obj->lg;
	 $this->id 	= $obj->id;
	}
	
	public function getList($search) {
		
		
		
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		
		$this->db->addFrom('is_product'); 
		
		 $this->db->addWhere(' `publier` = 1');
		$this->db->addOrderBy('ordre'); 
		
		 
		 if (!$this->db->select()){  echo 'ERREUR->LISTE: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {    $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }
	 
	  
	 
	 public function getDetail() {
	 
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('is_product'); 
		$this->db->addWhere(' id = :id');
		$this->db->addParamToBind('id', $this->id );
		

 
		 if (!$this->db->select()){  echo 'ERREUR->DETAILS: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {    $row  =   $this->db->getNextRow(); }
		
	  return $row ;
	
	} 
	public function getTabsContent() {
	
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		 
		$this->db->addFrom('`is_contenu` as c   ');
		$this->db->addWhere(' c.id_item = :id');
		$this->db->addParamToBind('id', $this->id );
		
		$this->db->addWhere(' c.id_langue = :lg');
		$this->db->addWhere(' c.publier = 1');
		
				$this->db->addOrderBy('ordre'); 
				
		$this->db->addParamToBind('lg', ucfirst($this->lg) );
		

		$this->db->addWhere('c.id_appli =8');
		
  	if (!$this->db->select()){  echo 'ERREUR->DESCRIPTIONS TABS: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {    $row  =  $this->db->getAllRows(); }
		//echo str_replace(":lg","'".$this->lg."'",$this->db->q); 
		return $row ;
	
	}
	
	 
	public function getSim( $lien) { 
	
		if (!empty($lien)) {
	    $this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('is_product'); 
		$this->db->addWhere(' id IN ( '.$lien.'  )' );
		 
	 if (!$this->db->select()){  echo 'ERREUR->SIMILAIRES: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {  $row  =   $this->db->getAllRows();   }
		
	  return $row ; } else {
	  
	  return '';
	  }
    
	
	} 
	
	
	public function addClick($id){
		 
			$this->db->resetUpdate();
			$this->db->setTableToUpdate('is_product');
			$this->db->addUpdating('click', 'click+1');
			$this->db->setIdToUpdate('id = :id');
			$this->db->addParamToBind('id',$id);
						
			if ($this->db->update()) {
				  return true;
			}  
			else 
			{
				 return false;
			}	
		
		}

     
//Fin classe
}
?>
