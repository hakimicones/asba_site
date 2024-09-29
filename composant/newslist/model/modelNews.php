<?php 

class modelNewslist {
	public $db  ; 
	public $lg  ; 
	public $id ; 
	public function __construct($c)
	{
	 $obj   	= $c->obj;
	 $this->db  = $c->cx->db;
	 $this->lg	= $obj->lg;
	 $this->id 	= $obj->id;
	 $this->cx  = $c->cx->cx;	

	}
	
	public function getData($search) {
		
		
		
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		
		$this->db->addFrom('is_news1'); 
		 $this->db->addWhere(' `publier` = 1');
		$this->db->addOrderBy('date DESC'); 
		
		if (!empty($search)) {
		$s = "'%".$search."%'"; 
		$this->db->addWhere(  'title Like '.$s.'  ');
		 }
		 
		$this->db->addWhere('id_langue = :id_langue ' ); 
  		$this->db->addParamToBind('id_langue'  ,$this->lg );
  		
  		$this->db->addOrderBy('date DESC');
		 
		 if (!$this->db->select())
		 {  
			
			$this->cx->getMessageErr('Newslist->getData: '.$this->db->getErrMessage().'  '.$this->db->q);
			return '';
			 
		
		}
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }
	 
	 public function getDetail() 
	 {
	 
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('is_news'); 
		$this->db->addWhere(' id = :id');
		$this->db->addParamToBind('id', $this->id ); 
		
		 if (!$this->db->select()){  
			
			$this->cx->getMessageErr('Newslist->getDetail: '.$this->db->getErrMessage().'  '.$this->db->q);
			return ''; 	 
		}
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
