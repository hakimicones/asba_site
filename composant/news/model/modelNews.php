<?php 

class modelNews {
	public $db  ; 
	public $lg  ; 
	public $id ; 
	public function __construct($db,$obj)
	{

	 $this->db  = $db;
	 $this->lg	= $obj->lg;
	 $this->id 	= $obj->id;
	}
	
	public function getData($search) {
		
		
		
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		
		$this->db->addFrom('is_news'); 
		 $this->db->addWhere(' `publier` = 1');
		$this->db->addOrderBy('ordre'); 
		
		if (!empty($search)) {
		$s = "'%".$search."%'"; 
		$this->db->addWhere(  'title Like '.$s.'  ');
		 }
		 
		$this->db->addWhere('id_langue = :id_langue ' ); 
  		$this->db->addParamToBind('id_langue'  ,$this->lg );
  		
  		$this->db->addOrderBy('date DESC');
		 
		 if (!$this->db->select()){  echo 'ERREUR->LISTE: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }
	 
	 public function getDetail() {
	 
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('is_news'); 
		$this->db->addWhere(' id = :id');
		$this->db->addParamToBind('id', $this->id ); 
		
		 if (!$this->db->select()){  echo 'ERREUR->DETAILS: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {    $row  =   $this->db->getNextRow(); }
		
	  return $row ;
	
	} 
	 
	
	 
 
	
	
	public function addClick($id){
		 
			$this->db->resetUpdate();
			$this->db->setTableToUpdate('is_news');
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
