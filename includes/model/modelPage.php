<?php 
class modelPage {
	public $db;
	public $param;
	public $ispage;

	public function __construct($c)
	{
	  
	 $this->db    = $c;
	
	}
    public function getParent($src) {
	
		$this->db->resetSelect();
		$this->db->addSelected('*', '');
		$this->db->addFrom('is_mega_menu');
		$this->db->addWhere('id = :id'); 
		$this->db->addParamToBind('id', $src );
		
		
		if (!$this->db->select()){  echo 'ERREUR->Elements: '.$this->db->getErrMessage().'<br><br>'; return '';  }
			else {   $this->rows = $this->db->getNextRow(); }
			  
		return $this->rows ; 
	 
	
	 
	}
	public function getPages($id) {
	$db = $this->db;
	 $db->emptyParams();
	 $db->resetSelect();
	 $db->addSelected('*',  '');
	  	 	 
	 $db->addFrom('is_page');
	 $db->addWhere('id = :id  ');
 	 $db->addParamToBind('id', $id );  
	 $db->addWhere('publier = 1  ');
	 
	 
		if (!$db->select()) { echo 'ERREUR: Pages '.$db->getErrMessage().'<br><br>'; }
				else { 
				 
					 $page = $db->getNextRow() ;
					 
					 return $page;
					 }}
					 
	public function getIdVedette($lg) {
	 $db = $this->db;
	 $db->emptyParams();
	 $db->resetSelect();
	 $db->addSelected('id', ''); 
	 
	 $db->addFrom('is_page');
	 $db->addWhere('vedette = 1');
	 $db->addWhere('id_langue =  '."'".ucfirst($lg)."'" );
	 //$db->addParamToBind('id_langue', ); 
	 
	 			if (!$db->select()) { echo 'ERREUR: Pages '.$db->getErrMessage().'<br><br>'; }
				else { 
				 	
					 $p = $db->getNextRow() ;
				 
					 return $p['id'];
					 }
	  
	 
	 
	 }				 

		public function addClick($id){
		 
			$this->db->resetUpdate();
			$this->db->setTableToUpdate('is_page');
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


		public function insertStat($row) {
		
		$this->db->resetInsert();
		$this->db->setTableForInsert('is_stats');
		
		$this->db->addInserting('date', ':date');
		$this->db->addInserting('ip', ':ip');
		$this->db->addInserting('page', ':page');
		$this->db->addInserting('host', ':host');
		$this->db->addInserting('navigateur', ':navigateur');
		$this->db->addInserting('referer', ':referer');
 
		
		$this->db->addParamToBind('date',$row ->date);
		$this->db->addParamToBind('page',$row ->page);
		$this->db->addParamToBind('ip',$row ->ip);
		$this->db->addParamToBind('host',$row ->host);
		$this->db->addParamToBind('navigateur',$row ->navigateur);
		$this->db->addParamToBind('referer',$row ->referer);
		 
		// insertion des �l�ments dans la base de donn�es
		 if ($this->db->insert()) {
           
			
        }
        else {
		
			echo 'ERREUR INSERTION STATISTIQUE : '.$this->db->getErrMessage()  ;
            
        }
			
		}

//Fin classe
}
?>
