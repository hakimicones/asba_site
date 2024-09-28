<?php 
	class recherchesModel {
	
	public $rows;
	public $html;
	public $user;
	public $db;
	public $nbr;
	public $message = array() ;

	public function __construct($c)
		{
			$this->html  		= $c; 
			 
			$this->db    		= $c->cx->db;
			$this->lg           = $c->cx->lg; 
			 
			 
		}
		
		
	public function getContenu($rech) {
	
 	 	 	 	 	 		 			   
		$this->db->emptyParams();
		$this->db->resetSelect();	
		$this->db->addSelected('c.libelle   ', '');	 
		  				  		
		$this->db->addSelected('p.title', '');
 
		$this->db->addSelected('p.id', '');
		 
	 	$this->db->addFrom('is_contenu as c , `is_page` as p');
		$this->db->addWhere('c.id_item = p.id');		 
		$this->db->addWhere('p.publier = 1 ');
		
		$this->db->addWhere("( c.libelle LIKE :rech OR intro_text LIKE :rech OR p.title Like :rech  )");
		$this->db->addParamToBind('rech', '%'.$rech.'%');
		
		
		$this->db->addOrderBy('ordre ASC');
		
		$this->db->addGroupBy('ibelle,title,id');
		
	   
		$data = new stdClass;
				
		if (!$this->db->select()){  
		
		$data->erreur = 'Recherches->getContenu: '.$this->db->getErrMessage().'<br><br>'.$this->db->q;
		$data->Row = array();
		
		
		        }
			else {   $data->Row  = $this->db->getAllRows();	 $data->erreur ='';	 }
		//   echo  $this->db->q ;
		return $data;
}

   /*********************************************/
 
	 
	public function getFatawa($rech) {
 	 	 	 	 	 		 	
		$this->db->emptyParams();
		$this->db->resetSelect();	
		$this->db->addSelected('*   ', '');	 
		  				  		
		 
		 
	 	$this->db->addFrom('is_fatawa');
		 		 
		$this->db->addWhere(' publier = 1 ');
		
		$this->db->addWhere("  title LIKE :rech OR full_text LIKE :rech    ");
		$this->db->addParamToBind('rech', '%'.$rech.'%');
		
		
		$this->db->addOrderBy('ordre ASC');
		
	   
		$data = new stdClass;
				
		if (!$this->db->select()){  
		
		$data->erreur = 'Recherches->getFatawa: '.$this->db->getErrMessage().'<br><br>'.$this->db->q;
		$data->Row = array();
		
		
		        }
			else {   $data->Row  = $this->db->getAllRows();	 $data->erreur ='';	 }
		   // echo   $this->db->q ;
		return $data;						
								
			 
}

public function getProds($rech) {

//$this->db->addWhere('c.id_appli =8');
$this->db->emptyParams();
		$this->db->resetSelect();	
		$this->db->addSelected('c.libelle   ', '');	 
		  				  		
		$this->db->addSelected("CONCAT( p.libelle_".$this->lg.",' ( ',c.libelle,' )')", 'title');
 
		$this->db->addSelected('p.id', '');
		 
	 	$this->db->addFrom('is_contenu as c , is_product as p');
		$this->db->addWhere('c.id_item = p.id');		 
		$this->db->addWhere('c.publier = 1 ');
		$this->db->addWhere('c.id_appli =8');
		$this->db->addWhere(" c.id_langue = '".ucfirst($this->lg)."'" );
		
		$this->db->addWhere("( c.libelle LIKE :rech OR intro_text LIKE :rech OR libelle_".$this->lg." Like :rech  )");
		$this->db->addParamToBind('rech', '%'.$rech.'%');
		
		
		$this->db->addOrderBy('p.ordre ASC');
		
	   
		$data = new stdClass;
				
		if (!$this->db->select()){  
		
		$data->erreur = 'ERREUR->getProds: '.$this->db->getErrMessage().'<br><br>'.$this->db->q;
		$data->Row = array();
		
		
		        }
			else {   $data->Row  = $this->db->getAllRows();	 $data->erreur ='';	 }
		  //  echo  $this->db->q ;
		return $data;
		
		
		}

 
public function getNews( $rech) {

		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		
		$this->db->addFrom('is_news'); 
		$this->db->addWhere(' `publier` = 1');
		
		$this->db->addWhere("  title LIKE :rech OR full_text LIKE :rech    ");
		$this->db->addParamToBind('rech', '%'.$rech.'%');
		
		
		$this->db->addOrderBy('ordre ASC');
		
	   
		$data = new stdClass;
				
		if (!$this->db->select()){  
		
		$data->erreur = 'ERREUR->getNews: '.$this->db->getErrMessage().'<br><br>'.$this->db->q;
		$data->Row = array();
		
		
		        }
			else {   $data->Row  = $this->db->getAllRows();	 $data->erreur ='';	 }
		   // echo   $this->db->q ;
		return $data;					
}
	  
	 /*************************
	  * Fin classe
	  **************************/
}